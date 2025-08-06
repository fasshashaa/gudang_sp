<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gudang SP</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background-color: #eef1f4;
        }
        .navbar {
            background-color: #007BFF;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        .navbar h1 {
            margin: 0;
            font-size: 1.5rem;
        }
        .navbar .search-form {
            display: flex;
            align-items: center;
        }
        .navbar .search-form input[type="text"] {
            border: none;
            padding: 10px 15px;
            border-radius: 20px;
            width: 300px;
            transition: all 0.3s ease;
            outline: none;
        }
        .navbar .search-form input[type="text"]:focus {
            width: 350px;
        }
        .add-button {
            background-color: transparent;
            color: white;
            border: 1px solid white;
            padding: 10px 15px;
            cursor: pointer;
            margin-left: 15px;
            border-radius: 20px;
            transition: all 0.3s ease;
            font-size: 1rem;
        }
        .add-button:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: scale(1.05);
        }
        .add-button i {
            margin-right: 8px;
        }
        .container {
            padding: 20px;
            max-width: 1200px;
            margin: 20px auto;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        table { 
            width: 100%; 
            border-collapse: separate; 
            border-spacing: 0;
            margin-top: 20px; 
            border-radius: 8px;
            overflow: hidden;
        }
        th, td { 
            padding: 12px 15px; 
            text-align: left; 
            border-bottom: 1px solid #ddd;
        }
        th { 
            background-color: #f2f2f2;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.9em;
        }
        tr.main-row {
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        tr.main-row:hover {
            background-color: #f9f9f9;
        }
        tr.detail-row {
            display: none;
            background-color: #f7f7f7;
            font-size: 0.9em;
            color: #555;
        }
        tr.detail-row td {
            padding-left: 30px;
            border-top: none;
        }
        .alert { 
            padding: 15px; 
            border-radius: 5px; 
            margin-bottom: 20px;
            font-weight: bold;
        }
        .alert.success { 
            background-color: #d4edda; 
            color: #155724; 
            border: 1px solid #c3e6cb; 
        }
        .alert.error { 
            background-color: #f8d7da; 
            color: #721c24; 
            border: 1px solid #f5c6cb; 
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1001;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.6);
            padding-top: 60px;
            animation: fadeIn 0.3s ease;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 30px;
            border: none;
            border-radius: 10px;
            width: 90%;
            max-width: 900px; /* Lebarkan modal untuk form horizontal */
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            animation: slideIn 0.3s ease-out;
        }
        .close, .closeEdit {
            color: #aaa;
            float: right;
            font-size: 32px;
            font-weight: bold;
            transition: color 0.2s;
        }
        .close:hover, .closeEdit:hover,
        .close:focus, .closeEdit:focus {
            color: #333;
            text-decoration: none;
            cursor: pointer;
        }
        /* Style untuk form horizontal */
        .modal-content form { 
            margin-top: 20px; 
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* Atur menjadi 2 kolom */
            gap: 20px; /* Jarak antar item form */
        }
        .modal-content form > div {
            margin-bottom: 0; /* Hapus margin bawah default */
        }
        .modal-content form > button {
            grid-column: 1 / -1; /* Tombol submit menempati seluruh lebar grid */
            margin-top: 10px;
        }
        
        label { 
            display: block; 
            margin-bottom: 8px;
            font-weight: 600;
        }
        input[type="text"], input[type="number"] { 
            width: 100%; 
            padding: 10px; 
            box-sizing: border-box; 
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.2s;
        }
        input[type="text"]:focus, input[type="number"]:focus {
            border-color: #007BFF;
            outline: none;
        }
        button[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
            transition: background-color 0.2s ease;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        .action-buttons button {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .action-buttons .editBtn {
            background-color: #ffc107;
            margin-right: 5px;
        }
        .action-buttons .editBtn:hover {
            background-color: #e0a800;
        }
        .action-buttons .deleteBtn {
            background-color: #dc3545;
        }
        .action-buttons .deleteBtn:hover {
            background-color: #c82333;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>Gudang Sparepart</h1>
        <form id="searchForm" class="search-form" action="#" method="GET">
            <input type="text" id="searchInput" name="search" placeholder="Cari barang...">
        </form>
        <button id="openModalBtn" class="add-button"><i class="fas fa-plus fa-sm"></i> Tambah</button>
    </nav>

    <div class="container">
        <div id="statusMessage"></div>
        
        <table>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Machine</th>
                    <th>Nama Barang</th>
                    <th>Spesifikasi</th>
                    <th>Kotak</th>
                    <th>Penutupan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="barang-table-body">
                @foreach ($barangs as $barang)
                <tr class="main-row" data-code="{{ $barang->code }}">
                    <td class="code">{{ $barang->code }}</td>
                    <td class="machine">{{ $barang->machine }}</td>
                    <td class="name_of_good">{{ $barang->name_of_good }}</td>
                    <td class="specification">{{ $barang->detail->specification ?? 'N/A' }}</td>
                    <td class="box">{{ $barang->detail->box ?? 'N/A' }}</td>
                    <td class="closing">{{ $barang->detail->closing ?? 'N/A' }}</td>
                    <td class="action-buttons">
                        <button class="editBtn"><i class="fas fa-edit"></i></button>
                        <button class="deleteBtn"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
                <tr class="detail-row">
                    <td colspan="7">
                        <p><strong>Penggunaan 2024:</strong> <span class="using_2024">{{ $barang->detail->using_2024 ?? 'N/A' }}</span></p>
                        <p><strong>Pembukaan:</strong> <span class="opening">{{ $barang->detail->opening ?? 'N/A' }}</span></p>
                        <p><strong>Diterima:</strong> <span class="received">{{ $barang->detail->received ?? 'N/A' }}</span></p>
                        <p><strong>Digunakan:</strong> <span class="used">{{ $barang->detail->used ?? 'N/A' }}</span></p>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div id="addBarangModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Tambah Barang Baru</h2>
                <form id="addBarangForm">
                    @csrf
                    <div><label for="code">Code:</label><input type="text" id="code" name="code" required></div>
                    <div><label for="machine">Machine:</label><input type="text" id="machine" name="machine" required></div>
                    <div><label for="name_of_good">Nama Barang:</label><input type="text" id="name_of_good" name="name_of_good" required></div>
                    <div><label for="specification">Spesifikasi:</label><input type="text" id="specification" name="specification" required></div>
                    <div><label for="box">Kotak:</label><input type="text" id="box" name="box" required></div>
                    <div><label for="using_2024">Penggunaan 2024:</label><input type="number" id="using_2024" name="using_2024" required></div>
                    <div><label for="opening">Pembukaan:</label><input type="number" id="opening" name="opening" required></div>
                    <div><label for="received">Diterima:</label><input type="number" id="received" name="received" required></div>
                    <div><label for="used">Digunakan:</label><input type="number" id="used" name="used" required></div>
                    <div><label for="closing">Penutupan:</label><input type="number" id="closing" name="closing" required></div>
                    <button type="submit">Simpan</button>
                </form>
            </div>
        </div>

        <div id="editBarangModal" class="modal">
            <div class="modal-content">
                <span class="closeEdit">&times;</span>
                <h2>Edit Barang</h2>
                <form id="editBarangForm">
                    @csrf
                    @method('PUT')
                    <div><label for="edit-code">Code:</label><input type="text" id="edit-code" name="code" required></div>
                    <div><label for="edit-machine">Machine:</label><input type="text" id="edit-machine" name="machine" required></div>
                    <div><label for="edit-name_of_good">Nama Barang:</label><input type="text" id="edit-name_of_good" name="name_of_good" required></div>
                    <div><label for="edit-specification">Spesifikasi:</label><input type="text" id="edit-specification" name="specification" required></div>
                    <div><label for="edit-box">Kotak:</label><input type="text" id="edit-box" name="box" required></div>
                    <div><label for="edit-using_2024">Penggunaan 2024:</label><input type="number" id="edit-using_2024" name="using_2024" required></div>
                    <div><label for="edit-opening">Pembukaan:</label><input type="number" id="edit-opening" name="opening" required></div>
                    <div><label for="edit-received">Diterima:</label><input type="number" id="edit-received" name="received" required></div>
                    <div><label for="edit-used">Digunakan:</label><input type="number" id="edit-used" name="used" required></div>
                    <div><label for="edit-closing">Penutupan:</label><input type="number" id="edit-closing" name="closing" required></div>
                    <button type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        var addModal = document.getElementById("addBarangModal");
        var editModal = document.getElementById("editBarangModal");
        var openAddModalBtn = document.getElementById("openModalBtn");
        var closeAddModalBtn = document.getElementsByClassName("close")[0];
        var closeEditModalBtn = document.getElementsByClassName("closeEdit")[0];
        var addForm = document.getElementById("addBarangForm");
        var editForm = document.getElementById("editBarangForm");
        var statusMessage = document.getElementById("statusMessage");
        var barangTableBody = document.getElementById("barang-table-body");
        
        var searchInput = document.getElementById('searchInput');

        // Toggle detail row when main row is clicked
        barangTableBody.addEventListener('click', function(event) {
            const row = event.target.closest('.main-row');
            if (row && !event.target.closest('.action-buttons')) {
                const detailRow = row.nextElementSibling;
                if (detailRow && detailRow.classList.contains('detail-row')) {
                    if (detailRow.style.display === 'table-row') {
                        detailRow.style.display = 'none';
                    } else {
                        detailRow.style.display = 'table-row';
                    }
                }
            }
        });

        // Live search logic
        searchInput.addEventListener('input', function() {
            const searchValue = searchInput.value.toLowerCase();
            const rows = barangTableBody.querySelectorAll('.main-row');

            rows.forEach(row => {
                const detailRow = row.nextElementSibling;
                const code = row.querySelector('.code').innerText.toLowerCase();
                const machine = row.querySelector('.machine').innerText.toLowerCase();
                const nameOfGood = row.querySelector('.name_of_good').innerText.toLowerCase();
                const specification = row.querySelector('.specification').innerText.toLowerCase();
                const closing = row.querySelector('.closing').innerText.toLowerCase();

                if (code.includes(searchValue) || machine.includes(searchValue) || nameOfGood.includes(searchValue) || specification.includes(searchValue) || closing.includes(searchValue)) {
                    row.style.display = '';
                    if (detailRow && detailRow.classList.contains('detail-row')) {
                        detailRow.style.display = row.style.display; // Ensure detail row visibility matches main row
                    }
                } else {
                    row.style.display = 'none';
                    if (detailRow && detailRow.classList.contains('detail-row')) {
                        detailRow.style.display = 'none';
                    }
                }
            });
        });

        function showStatus(message, type = 'success') {
            statusMessage.innerHTML = message;
            statusMessage.className = 'alert ' + type;
            setTimeout(() => {
                statusMessage.innerHTML = '';
                statusMessage.className = '';
            }, 3000);
        }
        
        openAddModalBtn.onclick = function() {
            addModal.style.display = "block";
        }

        closeAddModalBtn.onclick = function() {
            addModal.style.display = "none";
        }
        
        closeEditModalBtn.onclick = function() {
            editModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == addModal) {
                addModal.style.display = "none";
            }
            if (event.target == editModal) {
                editModal.style.display = "none";
            }
        }

        function createTableRow(barang) {
            const mainRow = document.createElement('tr');
            mainRow.className = 'main-row';
            mainRow.dataset.code = barang.code;
            mainRow.innerHTML = `
                <td class="code">${barang.code}</td>
                <td class="machine">${barang.machine}</td>
                <td class="name_of_good">${barang.name_of_good}</td>
                <td class="specification">${barang.detail.specification ?? 'N/A'}</td>
                <td class="box">${barang.detail.box ?? 'N/A'}</td>
                <td class="closing">${barang.detail.closing ?? 'N/A'}</td>
                <td class="action-buttons">
                    <button class="editBtn"><i class="fas fa-edit"></i></button>
                    <button class="deleteBtn"><i class="fas fa-trash-alt"></i></button>
                </td>
            `;

            const detailRow = document.createElement('tr');
            detailRow.className = 'detail-row';
            detailRow.innerHTML = `
                <td colspan="7">
                    <p><strong>Penggunaan 2024:</strong> <span class="using_2024">${barang.detail.using_2024 ?? 'N/A'}</span></p>
                    <p><strong>Pembukaan:</strong> <span class="opening">${barang.detail.opening ?? 'N/A'}</span></p>
                    <p><strong>Diterima:</strong> <span class="received">${barang.detail.received ?? 'N/A'}</span></p>
                    <p><strong>Digunakan:</strong> <span class="used">${barang.detail.used ?? 'N/A'}</span></p>
                </td>
            `;

            mainRow.querySelector('.editBtn').addEventListener('click', handleEditClick);
            mainRow.querySelector('.deleteBtn').addEventListener('click', handleDeleteClick);
            
            return [mainRow, detailRow];
        }

        function handleEditClick(event) {
            event.stopPropagation();
            var mainRow = event.target.closest('.main-row');
            var detailRow = mainRow.nextElementSibling;

            var code = mainRow.dataset.code;
            var machine = mainRow.querySelector('.machine').innerText;
            var name_of_good = mainRow.querySelector('.name_of_good').innerText;
            var specification = mainRow.querySelector('.specification').innerText;
            var box = mainRow.querySelector('.box').innerText;
            var closing = mainRow.querySelector('.closing').innerText;
            
            var using_2024 = detailRow.querySelector('.using_2024').innerText;
            var opening = detailRow.querySelector('.opening').innerText;
            var received = detailRow.querySelector('.received').innerText;
            var used = detailRow.querySelector('.used').innerText;
            
            editForm.action = '/barang/' + code;
            document.getElementById('edit-code').value = code;
            document.getElementById('edit-machine').value = machine;
            document.getElementById('edit-name_of_good').value = name_of_good;
            document.getElementById('edit-specification').value = specification;
            document.getElementById('edit-box').value = box;
            document.getElementById('edit-using_2024').value = using_2024;
            document.getElementById('edit-opening').value = opening;
            document.getElementById('edit-received').value = received;
            document.getElementById('edit-used').value = used;
            document.getElementById('edit-closing').value = closing;

            editModal.style.display = "block";
        }
        
        function handleDeleteClick(event) {
            event.stopPropagation();
            var mainRow = event.target.closest('.main-row');
            var detailRow = mainRow.nextElementSibling;
            var code = mainRow.dataset.code;

            if (confirm('Apakah Anda yakin ingin menghapus barang dengan kode ' + code + '?')) {
                fetch('/barang/' + code, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showStatus(data.message);
                        mainRow.remove();
                        if (detailRow && detailRow.classList.contains('detail-row')) {
                            detailRow.remove();
                        }
                    } else {
                        showStatus(data.message, 'error');
                    }
                })
                .catch(error => {
                    showStatus('Gagal terhubung ke server.', 'error');
                    console.error('Error:', error);
                });
            }
        }
        
        document.querySelectorAll('.editBtn').forEach(button => {
            button.addEventListener('click', handleEditClick);
        });
        document.querySelectorAll('.deleteBtn').forEach(button => {
            button.addEventListener('click', handleDeleteClick);
        });

        addForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            const formData = new FormData(addForm);
            
            fetch('/barang', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showStatus(data.message);
                    const [newMainRow, newDetailRow] = createTableRow(data.data);
                    barangTableBody.appendChild(newMainRow);
                    barangTableBody.appendChild(newDetailRow);
                    addForm.reset();
                    addModal.style.display = 'none';
                } else {
                    let errorMessage = data.message;
                    if (data.errors) {
                        errorMessage += '<br>' + Object.values(data.errors).join('<br>');
                    }
                    showStatus(errorMessage, 'error');
                }
            })
            .catch(error => {
                showStatus('Gagal terhubung ke server.', 'error');
                console.error('Error:', error);
            });
        });

        editForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            const formData = new FormData(editForm);
            
            fetch(editForm.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-HTTP-Method-Override': 'PUT'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showStatus(data.message);
                    const mainRow = document.querySelector(`tr[data-code="${data.data.code}"]`);
                    if (mainRow) {
                        const detailRow = mainRow.nextElementSibling;
                        mainRow.querySelector('.code').innerText = data.data.code;
                        mainRow.querySelector('.machine').innerText = data.data.machine;
                        mainRow.querySelector('.name_of_good').innerText = data.data.name_of_good;
                        mainRow.querySelector('.specification').innerText = data.data.detail.specification ?? 'N/A';
                        mainRow.querySelector('.box').innerText = data.data.detail.box ?? 'N/A';
                        mainRow.querySelector('.closing').innerText = data.data.detail.closing ?? 'N/A';

                        if (detailRow) {
                            detailRow.querySelector('.using_2024').innerText = data.data.detail.using_2024 ?? 'N/A';
                            detailRow.querySelector('.opening').innerText = data.data.detail.opening ?? 'N/A';
                            detailRow.querySelector('.received').innerText = data.data.detail.received ?? 'N/A';
                            detailRow.querySelector('.used').innerText = data.data.detail.used ?? 'N/A';
                        }
                    }
                    editModal.style.display = 'none';
                } else {
                    let errorMessage = data.message;
                    if (data.errors) {
                        errorMessage += '<br>' + Object.values(data.errors).join('<br>');
                    }
                    showStatus(errorMessage, 'error');
                }
            })
            .catch(error => {
                showStatus('Gagal terhubung ke server.', 'error');
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>