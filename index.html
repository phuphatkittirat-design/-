<?php
session_start();

?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>หน้าหลัก</title>
    
</head>
<body>

<header>
    <h1>จองศาลา</h1>

    <nav>
        <ul>
            <li><a href="sala_list.php">จองศาลา</a></li>
            <li><a href="booking_table.php">ตารางการจอง</a></li>
            <li><a href="logout.php">ออกจากระบบ</a></li>
        </ul>
    </nav>

    <div class="user-profile" onclick="togglePopup()" style="cursor:pointer; text-align: center;">
    <span class="profile-icon">👤</span><br>
    <span class="profile-name"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
</div>


    <div id="profilePopup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="togglePopup()">&times;</span>
            <h3 style="text-align: center; margin-bottom: 20px;color: #007bff;">✏️ แก้ไขโปรไฟล์</h3>
            <form id="profileForm">
    <p>
    <label>
        ชื่อ: 
        <span class="edit-icon">🖉</span>
        <input type="text" name="username" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" required>
    </label>
</p>
<p>
    <label>
        อีเมล: 
        <span class="edit-icon">🖉</span>
        <input type="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" required>
    </label>
</p>
<p>
    <label>
        เบอร์โทร: 
        <span class="edit-icon">🖉</span>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($_SESSION['phone']); ?>" required>
    </label>
</p>

    <button type="submit">บันทึกข้อมูล</button>
    <p id="formMessage" style="color: green; display:none;"></p>
</form>

        </div>
    </div>
</header>

<main>
    <section>
        <h2>ศาลายอดนิยม</h2>
    </section>

    <div class="image-gallery"> 
        <div class="gallery-item">
            <a href="sala_detail.php?id=1">
                <img src="photo/unnamed.jpg" alt="รูปที่ 1" class="gallery-img" />
            </a>
            <p>฿3,000-5,000</p> 
            <p class="detail-text">รายละเอียดเพิ่มเติม</p>
        </div>

        <div class="gallery-item">
            <a href="sala_detail.php?id=2">
                <img src="photo/wat1.jpg" alt="รูปที่ 2" class="gallery-img" />
            </a>
            <p>฿3,000-5,000</p>
            <p class="detail-text">รายละเอียดเพิ่มเติม</p>
        </div>

        <div class="gallery-item">
            <a href="sala_detail.php?id=3">
                <img src="photo/wat2.jpg" alt="รูปที่ 3" class="gallery-img" />
            </a>
            <p>฿3,000-5,000</p>
            <p class="detail-text">รายละเอียดเพิ่มเติม</p>
        </div>
    </div>

    <section style="text-align: center; margin-top: 40px;">
        <h2>ปฏิทิน</h2>
        <div style="margin-bottom: 10px;">
            <select id="monthSelect"></select>
            <select id="yearSelect"></select>
        </div>
        <div id="calendar" style="margin: 0 auto;"></div>
    </section>
</main>

<script>
function togglePopup() {
    const popup = document.getElementById("profilePopup");
    popup.style.display = (popup.style.display === "block") ? "none" : "block";
}

window.addEventListener('click', function(event) {
    const popup = document.getElementById("profilePopup");
    const profile = document.querySelector(".user-profile");
    if (!popup.contains(event.target) && !profile.contains(event.target)) {
        popup.style.display = "none";
    }
});

const monthNames = ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];

function generateCalendar(month, year) {
    const calendarDiv = document.getElementById('calendar');
    calendarDiv.innerHTML = '';

    const daysOfWeek = ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'];

    const table = document.createElement('table');
    table.style.borderCollapse = 'collapse';
    table.style.width = '100%';
    table.style.maxWidth = '400px';
    table.style.margin = '0 auto';

    const headerRow = document.createElement('tr');
    daysOfWeek.forEach(day => {
        const th = document.createElement('th');
        th.textContent = day;
        th.style.border = '1px solid #ddd';
        th.style.padding = '8px';
        th.style.backgroundColor = '#f2f2f2';
        th.style.width = '14.28%';
        headerRow.appendChild(th);
    });
    table.appendChild(headerRow);

    const firstDay = new Date(year, month, 1);
    const startingDay = firstDay.getDay();

    const daysInMonth = new Date(year, month + 1, 0).getDate();

    let date = 1;
    for(let i = 0; i < 6; i++) {
        const row = document.createElement('tr');

        for(let j = 0; j < 7; j++) {
            const cell = document.createElement('td');
            cell.style.border = '1px solid #ddd';
            cell.style.padding = '8px';
            cell.style.textAlign = 'center';
            cell.style.height = '40px';
            cell.style.cursor = 'pointer';

            if(i === 0 && j < startingDay) {
                cell.textContent = '';
            } else if(date > daysInMonth) {
                cell.textContent = '';
            } else {
                cell.textContent = date;
                cell.addEventListener('click', () => {
                    alert(`คุณเลือกวันที่ ${date} ${monthNames[month]} ${year}`);
                });
                date++;
            }

            row.appendChild(cell);
        }

        table.appendChild(row);

        if(date > daysInMonth) {
            break;
        }
    }

    calendarDiv.appendChild(table);
}

function populateMonthSelect() {
    const monthSelect = document.getElementById('monthSelect');
    monthNames.forEach((m, i) => {
        const option = document.createElement('option');
        option.value = i;
        option.text = m;
        monthSelect.appendChild(option);
    });
}

function populateYearSelect(startYear, endYear) {
    const yearSelect = document.getElementById('yearSelect');
    for(let y = startYear; y <= endYear; y++) {
        const option = document.createElement('option');
        option.value = y;
        option.text = y;
        yearSelect.appendChild(option);
    }
}

function setupCalendar() {
    const today = new Date();
    const currentMonth = today.getMonth();
    const currentYear = today.getFullYear();

    populateMonthSelect();
    populateYearSelect(currentYear - 10, currentYear + 10);

    const monthSelect = document.getElementById('monthSelect');
    const yearSelect = document.getElementById('yearSelect');

    monthSelect.value = currentMonth;
    yearSelect.value = currentYear;

    generateCalendar(currentMonth, currentYear);

    monthSelect.addEventListener('change', () => {
        generateCalendar(parseInt(monthSelect.value), parseInt(yearSelect.value));
    });

    yearSelect.addEventListener('change', () => {
        generateCalendar(parseInt(monthSelect.value), parseInt(yearSelect.value));
    });
}

setupCalendar();


// เพิ่ม AJAX submit สำหรับแก้ไขข้อมูลโปรไฟล์
document.getElementById('profileForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    fetch('profile_update.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const msg = document.getElementById('formMessage');
        if (data.status === 'success') {
            msg.style.color = 'green';
            msg.textContent = 'บันทึกข้อมูลเรียบร้อยแล้ว';
            msg.style.display = 'block';

            setTimeout(() => {
                msg.style.display = 'none';
                togglePopup();
                location.reload(); // โหลดหน้าใหม่เพื่ออัปเดตข้อมูลที่แสดง
            }, 1500);
        } else {
            msg.style.color = 'red';
            msg.textContent = 'เกิดข้อผิดพลาด: ' + (data.message || 'ไม่สามารถบันทึกข้อมูลได้');
            msg.style.display = 'block';
        }
    })
    .catch(err => {
        alert('เกิดข้อผิดพลาดในการเชื่อมต่อ: ' + err.message);
    });
});
</script>

</body>
</html>
