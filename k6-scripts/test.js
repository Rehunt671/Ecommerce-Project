import http from "k6/http";
import { check, sleep } from "k6";

export let options = {
    stages: [{ duration: "30s", target: 1 }],
};

export default function () {
    const res = http.get(
        "http://host.docker.internal:8000/products/category/1"
    );
    check(res, {
        "status is 200": (r) => r.status === 200,
    });
    sleep(1);
}
