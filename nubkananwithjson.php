<!DOCTYPE html>
<html lang="th">
<head>
	<meta charset="UTF-8">
	<title>ระบบนับคะแนนแบดมินตัน</title>
	<meta name="theme-color" content="hsl(26.4, 89.1%, 33.6%)" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

	<style>
		body { padding-right:0; padding-left:0; font-family: "Prompt", sans-serif;}

		.team-box { border: 2px solid #ccc; border-radius: 10px; padding: 20px; min-height: 200px; }
		.team-box h2 { cursor: pointer; }
		.history-box { max-height: 300px; overflow-y: auto; }
		.score{
			font-size: 384px;
		}
		.name1{
			padding-top: 1.5%;
			font-size: 72px;
		}
		.name2{
			padding-top: 1.5%;
			font-size: 72px;
		}
	</style>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


</head>
<body>


	<div class="container-fluid text-center">
		<div class="row" style="padding-right:0; padding-left: 0;">
			<div class="col-md-6 mb-3" style="background-color: rgb(255, 0, 0); padding-right:0; padding-left: 0;">
				<div class="input-group" id="panelnameteam1">
					<input type="text" class="form-control" id="nameteam1" placeholder="ชื่อทีมที่ 1">
					<button class="btn btn-outline-light" type="button" id="oknameteam1">Ok</button>
					<input type="text" id="team1Name" hidden>
					<script>
						$("#oknameteam1").click(function(){
							$("#team1Name").val($('#nameteam1').val());
							$("#name1").html($('#nameteam1').val());
							$("#panelnameteam1").hide();
						});
					</script>
				</div>
				<div style="min-height: 100vh; height: 100vh;">
					<div onclick="addPoint(1)" style="color:#fff; height: 100%;">
						<div  class="name1" id="name1"></div>
						<span class="score" id="score1">0</span>
					</div>
				</div>
			</div>
			


			<div class="col-md-6 mb-3" style="background-color: rgb(0, 0, 255); padding-right:0; padding-left: 0;">
				

				<div class="input-group" id="panelnameteam2">
					<input type="text" class="form-control" id="nameteam2" placeholder="ชื่อทีมที่ 2">
					<button class="btn btn-outline-light" type="button" id="oknameteam2">Ok</button>
					<input type="text" id="team2Name" hidden>
					<script>
						$("#oknameteam2").click(function(){
							$("#team2Name").val($('#nameteam2').val());
							$("#name2").html($('#nameteam2').val());
							$("#panelnameteam2").hide();
						});
					</script>
				</div>


				<div style="min-height: 100vh; height: 100vh;">
					<div onclick="addPoint(2)" style="color:#fff; height: 100%;">
						<div  class="name2" id="name2"></div>
						<span class="score" id="score2">0</span>
					</div>
				</div>
			</div>

			<div class="col-md-6 mb-3" style="padding-right:0; padding-left: 0;">
				<button class="btn btn-danger btn-sm" onclick="removePoint(1)">
					<i class="fa fa-minus"></i> -1 คะแนน
				</button>
			</div>
			<div class="col-md-6 mb-3" style="padding-right:0; padding-left: 0;">
				<button class="btn btn-danger btn-sm" onclick="removePoint(2)">
					<i class="fa fa-minus"></i> -1 คะแนน
				</button>
			</div>
			



		</div>

		<h3 id="result" class="text-warning"></h3>

		<div class="mb-3">
			<button class="btn btn-success me-2" onclick="saveMatch()"><i class="fa fa-floppy-disk"></i> บันทึกผล</button>
			<button class="btn btn-secondary me-2" onclick="resetMatch()"><i class="fa fa-rotate-left"></i> เริ่มใหม่</button>
			<button class="btn btn-outline-primary me-2" onclick="exportJSON()"><i class="fa fa-download"></i> Export JSON</button>
			<label class="btn btn-outline-info mb-0">
				<i class="fa fa-upload"></i> Import JSON
				<input type="file" hidden onchange="importJSON(event)">
			</label>
		</div>

		<div class="history-box text-start">
			<h4><i class="fa fa-clock"></i> ประวัติการแข่งขัน</h4>
			<ul id="matchHistory" class="list-group"></ul>
		</div>
	</div>

	<script>
		let score1 = 0;
		let score2 = 0;
		let gameOver = false;

		function updateUI() {
			document.getElementById("score1").textContent = score1;
			document.getElementById("score2").textContent = score2;
			checkWinner();
		}

		async function addPoint(team) {
			
			if (gameOver) return;
			if (team === 1){
				const updatescore1 = score1++;

			}else{
				score2++;
			}
			updateUI();
		}

		function removePoint(team) {
			if (gameOver) return;
			if (team === 1 && score1 > 0) score1--;
			else if (team === 2 && score2 > 0) score2--;
			updateUI();
		}

		function checkWinner() {
			if ((score1 >= 21 || score2 >= 21) && Math.abs(score1 - score2) >= 2) {
				declareWinner();
			} else if (score1 === 30 || score2 === 30) {
				declareWinner();
			}
		}

		function declareWinner() {
			gameOver = true;
			const team1Name = document.getElementById("team1Name").value || "ทีม 1";
			const team2Name = document.getElementById("team2Name").value || "ทีม 2";
			const winner = score1 > score2 ? team1Name : team2Name;
			document.getElementById("result").textContent = `🏆 ผู้ชนะ: ${winner}`;
			Swal.fire({ icon: 'success', title: `🎉 ${winner} ชนะ!`, showConfirmButton: false });
		}

		function saveMatch() {
			if (!gameOver) {
				Swal.fire('ยังไม่มีทีมชนะ!', 'ให้มีผู้ชนะก่อนจึงบันทึกได้', 'warning');
				return;
			}
			const team1Name = document.getElementById("team1Name").value || "ทีม 1";
			const team2Name = document.getElementById("team2Name").value || "ทีม 2";
			const match = `${team1Name} (${score1}) vs ${team2Name} (${score2})`;

			let history = JSON.parse(localStorage.getItem("matches") || "[]");
			history.unshift(match);
			localStorage.setItem("matches", JSON.stringify(history));
			renderHistory();
			Swal.fire('บันทึกสำเร็จ!', '', 'success');
		}

		function resetMatch() {
			score1 = 0;
			score2 = 0;
			gameOver = false;
			document.getElementById("result").textContent = "";
			updateUI();
		}

		function renderHistory() {
			const list = document.getElementById("matchHistory");
			list.innerHTML = "";
			const history = JSON.parse(localStorage.getItem("matches") || "[]");
			history.forEach((item, index) => {
				const li = document.createElement("li");
				li.className = "list-group-item d-flex justify-content-between align-items-center";
				li.innerHTML = `${item}
								<button class="btn btn-sm btn-outline-danger" onclick="deleteMatch(${index})">
								<i class="fa fa-trash"></i>
			</button>`;
			list.appendChild(li);
		});
		}

		function deleteMatch(index) {
			Swal.fire({
				title: 'ยืนยันการลบ?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'ลบ',
				cancelButtonText: 'ยกเลิก'
			}).then(result => {
				if (result.isConfirmed) {
					let history = JSON.parse(localStorage.getItem("matches") || "[]");
					history.splice(index, 1);
					localStorage.setItem("matches", JSON.stringify(history));
					renderHistory();
					Swal.fire('ลบแล้ว!', '', 'success');
				}
			});
		}

		function exportJSON() {
			const data = localStorage.getItem("matches") || "[]";
			const blob = new Blob([data], { type: "application/json" });
			const url = URL.createObjectURL(blob);

			const a = document.createElement("a");
			a.href = url;
			a.download = "match_history.json";
			a.click();

			URL.revokeObjectURL(url);
		}

		function importJSON(event) {
			const file = event.target.files[0];
			if (!file) return;

			const reader = new FileReader();
			reader.onload = function(e) {
				try {
					const data = JSON.parse(e.target.result);
					if (Array.isArray(data)) {
						localStorage.setItem("matches", JSON.stringify(data));
						renderHistory();
						Swal.fire('Import สำเร็จ!', '', 'success');
					} else {
						throw new Error();
					}
				} catch {
					Swal.fire('ไฟล์ไม่ถูกต้อง!', 'กรุณาเลือกไฟล์ JSON ที่ถูกต้อง', 'error');
				}
			};
			reader.readAsText(file);
		}

		renderHistory();

	
	    setInterval(function(){

	    	<?php
				$json = file_get_contents('kanannow.json');
				$obj = json_decode($json);
				echo "
				document.getElementById('score1').innerText = '".$obj->team_a."';
				document.getElementById('score2').innerText = '".$obj->team_b."';
				";
			?>

	    	// console.log('sss')
	    }, 2000);
    
</script>

</body>
</html>
