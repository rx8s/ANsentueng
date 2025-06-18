const firebaseConfig = {
    apiKey: "AIzaSyAYOWpVDOQ7Q-fxjZx0vTS3SDetUbWTMY4",
    authDomain: "ansentueng.firebaseapp.com",
    databaseURL: "https://ansentueng-default-rtdb.asia-southeast1.firebasedatabase.app",
    projectId: "ansentueng",
    storageBucket: "ansentueng.firebasestorage.app",
    messagingSenderId: "370408378735",
    appId: "1:370408378735:web:729d1a9e4c951fd844589a",
    measurementId: "G-75E8KLKM6Z"
  };

// เริ่มต้น Firebase
// firebase.initializeApp(firebaseConfig);
// const db = firebase.firestore();


firebase.initializeApp(firebaseConfig);
const db = firebase.firestore();




// ค่าบริการ
const baseFee = 80;  // ค่าลงทะเบียนสนาม
const gameFee = 20;   // ค่าต่อเกม

// เพิ่มผู้เล่น
function addPlayer() {
    const playerName = document.getElementById("playerName").value;
    if (playerName.trim() === "") return;

    db.collection("players").add({
        name: playerName,
        gamesPlayed: 0,
        totalFee: baseFee
    }).then(() => {
        console.log("เพิ่มสมาชิกสำเร็จ");
        document.getElementById("playerName").value = "";
        loadPlayers();
    });
}

// โหลดรายชื่อผู้เล่น
function loadPlayers() {
    db.collection("players").onSnapshot(snapshot => {
        const list = document.getElementById("playerList");
        list.innerHTML = "";
        snapshot.forEach(doc => {
            const data = doc.data();
            const li = document.createElement("li");
            li.textContent = `${data.name} | เกมที่เล่น: ${data.gamesPlayed} | ค่าบริการ: ${data.totalFee} บาท`;

            const btnPlay = document.createElement("button");
            btnPlay.textContent = "เล่นเกม";
            btnPlay.onclick = () => playGame(doc.id, data.gamesPlayed, data.totalFee);
            
            li.appendChild(btnPlay);
            list.appendChild(li);
        });
    });
}

// เพิ่มเกม และอัปเดตราคา
function playGame(playerId, gamesPlayed, totalFee) {
    const newGamesPlayed = gamesPlayed + 1;
    const newTotalFee = baseFee + (newGamesPlayed * gameFee);

    db.collection("players").doc(playerId).update({
        gamesPlayed: newGamesPlayed,
        totalFee: newTotalFee
    }).then(() => {
        console.log("อัปเดตจำนวนเกมและค่าบริการแล้ว");
    });
}

// โหลดข้อมูลเมื่อเปิดหน้าเว็บ
loadPlayers();