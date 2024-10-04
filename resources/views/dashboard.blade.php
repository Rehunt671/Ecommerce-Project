<x-app-layout>
<h5>Welcome Everyone</h5>  <!-- Added margin-bottom -->
    <div class="w-1/2 p-4 bg-white rounded-xl shadow-lg hover:shadow-2xl mb-6 px-6 mx-auto flex flex-col items-center text-center">
        <img src="{{ asset('/storage/logo.png') }}" class="img-fluid mb-3" alt="logo" />
        <p>สวัสดีครับยินดีต้อนรับสู่ร้านไม้เกาพุง ร้านขายของเกี่ยวกับสัตว์เลี้ยงที่ดีที่สุดเพื่อสัตว์เลี้ยงที่น่ารักของคุณ</p>
    </div>
    <!-- พี่โน่ -->
    <h5>Member's Info</h5>
    <div class="flex w-1/2 p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl mb-6 mx-auto">
    <div class="flex-none w-1/3">
        <img src="{{ asset('/storage/ceo.jpg') }}" alt="picture" style="width:100%; height: 250px; object-fit: cover; border-radius: 0.5rem;">
    </div>
    <div class="flex-1 p-6 text-left">
        <h4><b>Name : Thanawin Saithong</b></h4>
        <p>ID : 640610304</p>
        <p>Job Position : CEO</p>
        <p>Quote : "เขียนเว็บใช้ภาษา C รักกับพี่ใช้แค่ภาษาใจ"</p>
        <p>Pet : แมว </p>
        <p>Hobby : เล่นเกม เขียนโค้ด</p>
        <!-- ปุ่ม Facebook อยู่ในกรอบเดียวกัน -->
        <div class="mt-4">
            <a href="https://www.facebook.com/nattapol.inprom" target="_blank" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">
                View Facebook Profile
            </a>
        </div>
    </div>
</div>

    <!-- //ไบร์ท -->
    <div class="flex w-1/2 p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl mb-6 mx-auto">
    <div class="flex-none w-1/3">
        <img src="{{ asset('/storage/gm.png') }}" alt="picture" style="width: 100%; height: 250px; object-fit: cover; border-radius: 0.5rem;">
    </div>
    <div class="flex-1 p-6 text-left">
        <h4><b>Name : Panithan Boonmapi</b></h4>
        <p>ID : 650610782</p>
        <p>Job Position : General Manager </p>
        <p>Quote : "คนจริงไม่ skip leg day จำไว้เบบี๋"</p>
        <p>Pet : หมา</p>
        <p>Hobby : เล่นเกม เข้ายิม</p>
        <!-- ปุ่ม Facebook อยู่ในกรอบเดียวกัน -->
        <div class="mt-4">
            <a href="https://www.facebook.com/bright.panithan.5" target="_blank" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">
                View Facebook Profile
            </a>
        </div>
    </div>
</div>
   
    <!-- ภูมิ -->
    <div class="flex w-1/2 p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl mb-6 mx-auto">
    <div class="flex-none w-1/3">
        <img src="{{ asset('/storage/mk.jpg') }}" alt="picture" style="width: 100%; height: 250px; object-fit: cover; border-radius: 0.5rem;">
    </div>
    <div class="flex-1 p-6 text-left">
        <h4><b>Name : Phumrapee Tapwong</b></h4>
        <p>ID : 650610799</p>
        <p>Job Position : Marketing Manager </p>
        <p>Quote : "ตัวข้าน่ะ ไม่มีศัตรู"</p>
        <p>Pet : จระเข้</p>
        <p>Hobby : เล่นเกม ดูอนิเมะ ชอบ 86 eighty-six มาก</p>
        <!-- ปุ่ม Facebook อยู่ในกรอบเดียวกัน -->
        <div class="mt-4">
            <a href="https://www.facebook.com/phumrapee.tapwong" target="_blank" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">
                View Facebook Profile
            </a>
        </div>
    </div>
</div>
    
    <!-- แบงค์ -->
    <div class="flex w-1/2 p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl mb-6 mx-auto">
    <div class="flex-none w-1/3">
        <img src="{{ asset('/storage/tm.jpg') }}" alt="picture" style="width: 100%; height: 250px; object-fit: cover; border-radius: 0.5rem;">
    </div>
    <div class="flex-1 p-6 text-left">
        <h4><b>Name : Sirawit Kongkham</b></h4>
        <p>ID : 650610814</p>
        <p>Job Position : Technical Manager </p>
        <p>Quote : "เพราะผมไม่เหมือนแกะ อ่อนแอและอยู่เป็นฝูง เชอะ"</p>
        <p>Pet : หมา</p>
        <p>Hobby : เล่นเกม ดูอนิเมะ นอน</p>
        <!-- ปุ่ม Facebook อยู่ในกรอบเดียวกัน -->
        <div class="mt-4">
            <a href="https://www.facebook.com/sirawit.kongkham.7" target="_blank" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">
                View Facebook Profile
            </a>
        </div>
    </div>
</div>
   
    

</x-app-layout>
