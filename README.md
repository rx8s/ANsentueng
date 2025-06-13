# Badminton Score Counter (Frontend Only)

ระบบนับคะแนนการแข่งขันกีฬาแบดมินตัน  
✅ ไม่มี backend (HTML + JS ล้วน)  
✅ เก็บประวัติใน localStorage  
✅ สามารถ export/import ประวัติเป็นไฟล์ JSON  
✅ ใช้ Bootstrap, Font Awesome, SweetAlert2  

## 🎮 ฟีเจอร์หลัก

- นับคะแนนให้ทีม 2 ฝั่ง
- คลิกที่ชื่อทีมเพื่อเพิ่มคะแนน
- ลบคะแนนได้ในกรณีกดผิด
- รองรับกฎแบดมินตัน:
  - ผู้ชนะต้องได้ 21 แต้มขึ้นไปและนำห่าง 2 แต้ม
  - หาก 20-20 จะ deuce ไปจนกว่าจะนำห่าง 2 แต้ม หรือจนถึง 30 แต้ม
- แสดงผลผู้ชนะ
- บันทึกผลการแข่งขันใน localStorage
- แสดงประวัติการแข่งขันย้อนหลัง
- Export ประวัติเป็นไฟล์ JSON
- Import ประวัติจากไฟล์ JSON กลับเข้ามา

## 🖥️ วิธีใช้

1️⃣ clone repo หรือเปิดไฟล์ `index.html` ในเว็บเบราว์เซอร์  
```bash
$ git clone https://github.com/your-username/badminton-score-counter.git
$ cd badminton-score-counter
$ open index.html
```
หรือเพียงแค่เปิดไฟล์ index.html ในเบราว์เซอร์ (Chrome, Firefox, Edge)

2️⃣ ระบุชื่อทีม แล้วคลิกชื่อทีมหรือปุ่มเพื่อเพิ่มหรือลดคะแนน

3️⃣ เมื่อแข่งขันจบ กด บันทึกผล เพื่อบันทึกลงประวัติ

4️⃣ ใช้ปุ่ม Export JSON เพื่อดาวน์โหลดไฟล์ประวัติ
และปุ่ม Import JSON เพื่อโหลดไฟล์ประวัติที่เคยบันทึก

## 📦 เทคโนโลยีที่ใช้
HTML5

Vanilla JavaScript

Bootstrap 5

Font Awesome 6

SweetAlert2

📂 ไฟล์หลัก
index.html : โค้ดหลักของโปรแกรมทั้งหมด

(ไม่มี backend / server-side code)

🚀 Demo
👉 https://your-username.github.io/badminton-score-counter/

⚡ License
MIT License
ทำขึ้นเพื่อใช้ส่วนตัวและศึกษา สามารถ fork และนำไปพัฒนาต่อได้เลย

