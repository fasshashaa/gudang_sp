<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gudang SP</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #6C89BD;
            --primary-dark: #406bbb;
            --secondary-color: #2196F3;
            --text-color-dark: #333;
            --text-color-light: #fff;
            --bg-light: #f4f7f9;
            --bg-card: #ffffff;
            --border-color: #e0e0e0;
            --shadow-color: rgba(0, 0, 0, 0.1);
        }

             body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            color: var(--text-color-dark);
            -webkit-font-smoothing: antialiased;
            background-color: #eef4ff; /* Warna background fallback */
            /* Removed background-image from body to apply blur separately */
        }
        
        /* New CSS for blurred background */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('images/gal.png') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            filter: blur(6px); /* Adjust blur intensity here */
            transform: scale(1.05); /* Scale up to hide blurry edges */
            z-index: -1;
        }

        

        /* Navbar Styling */
        .navbar {
         background-color: #6c88bd8c;
            color: var(--text-color-light);
            padding: 1rem 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 12px var(--shadow-color);
            gap: 20px;
        }

        .navbar .logo-container {
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
        }

        .navbar .logo-container img {
            height: 40px;
        }

        .navbar h1 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .navbar .search-container {
            flex-grow: 1;
            display: flex;
            justify-content: center;
        }

        .navbar .search-container input[type="text"] {
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            width: 100%;
            max-width: 400px;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            outline: none;
            background-color: rgba(255, 255, 255, 0.9);
            color: var(--text-color-dark);
        }

        .navbar .search-container input[type="text"]::placeholder {
            color: #999;
        }

        .navbar .search-container input[type="text"]:focus {
            max-width: 500px;
            background-color: white;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }

        .navbar .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 1rem;
            font-weight: 500;
            color: var(--text-color-light);
            white-space: nowrap;
        }
        
        .navbar .user-info a.logout-btn {
            color: var(--text-color-light);
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 50px;
            background-color: rgba(255, 255, 255, 0.2);
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
        }

        .navbar .user-info a.logout-btn:hover {
            background-color: rgba(255, 255, 255, 0.4);
        }
        
        /* Main Container Styling */
        .container {
            padding: 3rem 2rem;
            max-width: 1300px;
            margin: 30px auto;
            background-color: var(--bg-card);
            box-shadow: 0 8px 20px var(--shadow-color);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 2rem;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        th, td {
            padding: 16px 20px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        th {
            background-color: #f8f9fa;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85em;
            color: #555;
            letter-spacing: 0.5px;
        }

        tr.main-row {
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        tr.main-row:hover {
            background-color: #f1f5f9;
        }
        
        tr.detail-row {
            display: none;
            background-color: #f7f9fb;
            font-size: 0.9em;
            color: #555;
            transition: all 0.3s ease-in-out;
        }

        tr.detail-row td {
            padding: 20px 30px;
            border-top: none;
        }

        /* Action Buttons Styling */
        .action-buttons button {
            padding: 8px 14px;
            border: none;
            border-radius: 50px;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .action-buttons .editBtn {
            background-color: #ffc107;
            margin-right: 8px;
        }

        .action-buttons .editBtn:hover {
            background-color: #e0a800;
            transform: scale(1.05);
        }

        .action-buttons .deleteBtn {
            background-color: #dc3545;
        }

        .action-buttons .deleteBtn:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }

        /* Add Item Button (Floating) */
        .add-button {
            background-color: #4caf4fa0; 
            color: white;
            border: none;
            padding: 15px 30px;
            cursor: pointer;
            border-radius: 50px;
            transition: all 0.3s ease;
            font-size: 1.2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1001;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .add-button:hover {
          background-color: #439846;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.25);
        }
        
        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1002;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.6);
            padding-top: 50px;
            animation: fadeIn 0.3s ease;
        }

        .modal-content {
            background-color: var(--bg-card);
            margin: auto;
            padding: 40px;
            border-radius: 12px;
            width: 90%;
            max-width: 800px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            animation: slideIn 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .close, .closeEdit {
            color: #999;
            float: right;
            font-size: 36px;
            font-weight: 300;
            transition: color 0.2s;
        }

        .close:hover, .closeEdit:hover,
        .close:focus, .closeEdit:focus {
            color: var(--text-color-dark);
            text-decoration: none;
            cursor: pointer;
        }

        .modal-content h2 {
            margin-top: 0;
            margin-bottom: 25px;
            font-weight: 600;
            font-size: 1.5rem;
            border-bottom: 2px solid var(--border-color);
            padding-bottom: 15px;
        }

        .modal-content form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .modal-content form > .full-width {
            grid-column: 1 / -1;
        }

        .modal-content form button[type="submit"] {
            grid-column: 1 / -1;
            margin-top: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #666;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 12px 15px;
            box-sizing: border-box;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            font-size: 1rem;
        }

        input[type="text"]:focus, input[type="number"]:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.2);
            outline: none;
        }
        
        button[type="submit"] {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 14px 25px;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-size: 1.1rem;
            font-weight: 600;
            transition: background-color 0.2s ease, transform 0.2s ease;
        }
        
        button[type="submit"]:hover {
            background-color: var(--primary-dark);
            transform: translateY(-1px);
        }
        
        /* Alert Message Styling */
        .alert {
            padding: 15px 25px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideInFromTop 0.5s ease;
        }

        .alert i {
            font-size: 1.2rem;
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

        /* Pagination Styling */
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 30px;
            padding: 10px;
        }

        .pagination-container nav > div:first-child {
            display: none;
        }

        .pagination-container nav > div:last-child {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .pagination-container nav > div:last-child > div:first-child {
            display: flex;
            align-items: center;
            white-space: nowrap;
            font-size: 0.9rem;
            color: #666;
            height: 36px;
        }

        .pagination-container .pagination-links {
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: none;
        }

        .pagination-container .pagination-links a,
        .pagination-container .pagination-links span {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 36px;
            min-width: 36px;
            font-size: 0.9rem;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.2s ease;
            text-decoration: none;
            box-sizing: border-box;
            border: 1px solid var(--border-color);
            background-color: var(--bg-card);
            color: var(--text-color-dark);
            padding: 0 8px;
            margin: 0 !important;
        }

        .pagination-container .pagination-links a:hover {
            background-color: #eef2f5;
            border-color: #eef2f5;
        }

        .pagination-container .pagination-links .pagination-active {
            background-color: var(--primary-color);
            color: var(--text-color-light);
            border-color: var(--primary-color);
        }

        .pagination-container .pagination-links .pagination-disabled {
            color: #ced4da;
            border-color: var(--border-color);
            cursor: not-allowed;
            background-color: #fff;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
                padding: 1rem;
                gap: 1rem;
            }

            .navbar .logo-container h1 {
                font-size: 1.1rem;
            }

            .navbar .search-container {
                width: 100%;
            }

            .navbar .search-container input[type="text"] {
                max-width: 100%;
            }

            .navbar .user-info {
                width: 100%;
                justify-content: space-between;
                border-top: 1px solid rgba(255, 255, 255, 0.2);
                padding-top: 1rem;
            }

            .container {
                padding: 1.5rem 1rem;
                margin: 20px auto;
            }

            .add-button {
                bottom: 20px;
                right: 20px;
                padding: 12px 20px;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo-container">
            <img src="{{ asset('images/nunggal.png') }}" alt="Logo Gudang SP">
            <h1>Gudang Sparepart</h1>
        </div>
        <div class="search-container">
            <input type="text" id="searchInput" name="search" placeholder="Search...">
        </div>
        @if (Auth::check())
            <div class="user-info">
                <span>Halo, {{ Auth::user()->name }}</span>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endif
    </nav>

    <button id="openModalBtn" class="add-button"><i class="fas fa-plus"></i> Add Items</button>

    <div class="container">
        <div id="statusMessage"></div>
        
        <table>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Machine</th>
                    <th>Name Of Good</th>
                    <th>Specification</th>
                    <th>Box</th>
                    <th>Closing</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="barang-table-body">
                @include('table_rows')
            </tbody>
        </table>
        
        <div class="pagination-container" id="pagination-links">
            {{ $barangs->links('vendor.pagination.custom') }}
        </div>

        <div id="addBarangModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>ADD ITEM</h2>
                <form id="addBarangForm">
                    @csrf
                    <div><label for="code">Code</label><input type="text" id="code" name="code" required></div>
                    <div><label for="machine">Machine</label><input type="text" id="machine" name="machine" required></div>
                    <div><label for="name_of_good">Name Of Good</label><input type="text" id="name_of_good" name="name_of_good" required></div>
                    <div><label for="specification">Specification</label><input type="text" id="specification" name="specification" required></div>
                    <div><label for="box">Box</label><input type="text" id="box" name="box" required></div>
                    <div><label for="using_2024">Using 2024</label><input type="number" id="using_2024" name="using_2024" required></div>
                    <div><label for="opening">Opening</label><input type="number" id="opening" name="opening" required></div>
                    <div><label for="received">Received</label><input type="number" id="received" name="received" required></div>
                    <div><label for="used">Used</label><input type="number" id="used" name="used" required></div>
                    <div><label for="closing">Closing</label><input type="number" id="closing" name="closing" required></div>
                    <button type="submit">Save</button>
                </form>
            </div>
        </div>

        <div id="editBarangModal" class="modal">
            <div class="modal-content">
                <span class="closeEdit">&times;</span>
                <h2>EDIT ITEM</h2>
                <form id="editBarangForm">
                    @csrf
                    @method('PUT')
                    <div><label for="edit-code">Code</label><input type="text" id="edit-code" name="code" required readonly></div>
                    <div><label for="edit-machine">Machine</label><input type="text" id="edit-machine" name="machine" required></div>
                    <div><label for="edit-name_of_good">Name Of Good</label><input type="text" id="edit-name_of_good" name="name_of_good" required></div>
                    <div><label for="edit-specification">Specification</label><input type="text" id="edit-specification" name="specification" required></div>
                    <div><label for="edit-box">Box</label><input type="text" id="edit-box" name="box" required></div>
                    <div><label for="edit-using_2024">Using 2024</label><input type="number" id="edit-using_2024" name="using_2024" required></div>
                    <div><label for="edit-opening">Opening</label><input type="number" id="edit-opening" name="opening" required></div>
                    <div><label for="edit-received">Received</label><input type="number" id="edit-received" name="received" required></div>
                    <div><label for="edit-used">Used</label><input type="number" id="edit-used" name="used" required></div>
                    <div><label for="edit-closing">Closing</label><input type="number" id="edit-closing" name="closing" required></div>
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

        document.addEventListener('DOMContentLoaded', function() {
            // Event delegation untuk baris utama (main-row) agar bisa diklik untuk menampilkan detail
            barangTableBody.addEventListener('click', function(event) {
                const row = event.target.closest('tr.main-row');
                if (row && !event.target.closest('.action-buttons')) {
                    const detailRow = row.nextElementSibling;
                    if (detailRow && detailRow.classList.contains('detail-row')) {
                        if (detailRow.style.display === 'table-row') {
                            detailRow.style.display = 'none';
                            row.classList.remove('expanded');
                        } else {
                            detailRow.style.display = 'table-row';
                            row.classList.add('expanded');
                        }
                    }
                }
            });

            // Event delegation untuk tombol Edit dan Delete
            barangTableBody.addEventListener('click', function(event) {
                const editBtn = event.target.closest('.editBtn');
                const deleteBtn = event.target.closest('.deleteBtn');

                if (editBtn) {
                    event.stopPropagation();
                    const mainRow = editBtn.closest('tr.main-row');
                    handleEditClick(mainRow);
                }

                if (deleteBtn) {
                    event.stopPropagation();
                    const mainRow = deleteBtn.closest('tr.main-row');
                    handleDeleteClick(mainRow);
                }
            });
        });

        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                const searchValue = searchInput.value;
                fetchBarangs(searchValue);
            }, 50);
        });
        
        function fetchBarangs(searchValue) {
            const url = `{{ route('barang.index') }}?search=${searchValue}`;
            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                let newTableContent = '';
                if (data.barangs && data.barangs.data.length > 0) {
                    data.barangs.data.forEach(barang => {
                        newTableContent += createRowHtml(barang);
                    });
                    barangTableBody.innerHTML = newTableContent;
                } else {
                    barangTableBody.innerHTML = '<tr><td colspan="7" style="text-align: center;">Tidak ada data ditemukan.</td></tr>';
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                showStatus('Gagal memuat data pencarian.', 'error');
            });
        }

        function createRowHtml(barang) {
            return `
                <tr class="main-row" data-code="${barang.code}">
                    <td class="code" data-label="Code">${barang.code}</td>
                    <td class="machine" data-label="Machine">${barang.machine}</td>
                    <td class="name_of_good" data-label="Name Of Good">${barang.name_of_good}</td>
                    <td class="specification" data-label="Specification">${barang.detail.specification ?? 'N/A'}</td>
                    <td class="box" data-label="Box">${barang.detail.box ?? 'N/A'}</td>
                    <td class="closing" data-label="Closing">${barang.detail.closing ?? 'N/A'}</td>
                    <td class="action-buttons" data-label="Action">
                        <button class="editBtn" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="deleteBtn" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
                <tr class="detail-row">
                    <td colspan="7">
                        <p><strong>Penggunaan 2024:</strong> <span class="using_2024">${barang.detail.using_2024 ?? 'N/A'}</span></p>
                        <p><strong>Pembukaan:</strong> <span class="opening">${barang.detail.opening ?? 'N/A'}</span></p>
                        <p><strong>Diterima:</strong> <span class="received">${barang.detail.received ?? 'N/A'}</span></p>
                        <p><strong>Digunakan:</strong> <span class="used">${barang.detail.used ?? 'N/A'}</span></p>
                    </td>
                </tr>
            `;
        }

        function showStatus(message, type = 'success') {
            statusMessage.innerHTML = `<i class="fas fa-info-circle"></i> ${message}`;
            statusMessage.className = 'alert ' + type;
            setTimeout(() => {
                statusMessage.innerHTML = '';
                statusMessage.className = '';
            }, 5000);
        }
        
        openAddModalBtn.onclick = function() {
            addModal.style.display = "block";
            addForm.reset();
        };

        closeAddModalBtn.onclick = function() {
            addModal.style.display = "none";
        };
        
        closeEditModalBtn.onclick = function() {
            editModal.style.display = "none";
        };

        window.onclick = function(event) {
            if (event.target == addModal) {
                addModal.style.display = "none";
            }
            if (event.target == editModal) {
                editModal.style.display = "none";
            }
        };

        function createTableRow(barang) {
            const mainRow = document.createElement('tr');
            mainRow.className = 'main-row';
            mainRow.dataset.code = barang.code;
            mainRow.innerHTML = `
                <td class="code" data-label="Code">${barang.code}</td>
                <td class="machine" data-label="Machine">${barang.machine}</td>
                <td class="name_of_good" data-label="Name Of Good">${barang.name_of_good}</td>
                <td class="specification" data-label="Specification">${barang.detail.specification ?? 'N/A'}</td>
                <td class="box" data-label="Box">${barang.detail.box ?? 'N/A'}</td>
                <td class="closing" data-label="Closing">${barang.detail.closing ?? 'N/A'}</td>
                <td class="action-buttons" data-label="Action">
                    <button class="editBtn" title="Edit"><i class="fas fa-edit"></i></button>
                    <button class="deleteBtn" title="Hapus"><i class="fas fa-trash-alt"></i></button>
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

            return [mainRow, detailRow];
        }

        function handleEditClick(mainRow) {
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
        
        function handleDeleteClick(mainRow) {
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
                    barangTableBody.prepend(newDetailRow);
                    barangTableBody.prepend(newMainRow);
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