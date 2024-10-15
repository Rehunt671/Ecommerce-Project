import http from "k6/http";
import { check, sleep } from "k6";

export let options = {
    // Define a realistic scenario with gradual ramp-up and ramp-down
    stages: [
        { duration: "2m", target: 100 },   // Ramp up to 100 users over 2 minutes
        { duration: "5m", target: 100 },   // Hold at 100 users for 5 minutes
        { duration: "2m", target: 200 },   // Ramp up to 200 users over 2 minutes
        { duration: "5m", target: 200 },   // Hold at 200 users for 5 minutes
        { duration: "2m", target: 0 },     // Ramp down to 0 users over 2 minutes
    ],
    thresholds: {
        http_req_duration: ['p(95)<500'], // Ensure 95% of requests are below 500ms
        http_req_failed: ['rate<0.01'],    // Fail rate should be less than 1%
    },
};

export default function () {
    const res = http.get("http://host.docker.internal:8000/product/category/1");
    check(res, {
        "status is 200": (r) => r.status === 200,
    });
    sleep(Math.random() * 2 + 1); 
}
