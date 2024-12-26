@extends('index')

@section('content')

<div id="page-content" class="container-fluid">
    <div id="mainContent">
        <!-- Button Container -->
        <form method="post">
            <div class="button-container mb-3">
                <button id="save-button" type="button" class="btn btn-primary">Save</button>
                <button id="add-button" type="button" class="btn btn-secondary">Add</button>
                <button id="back-button" type="button" class="btn btn-light">Back</button>
            </div>

            <!-- Audit Table -->
            <div class="table-responsive">
                <table id="auditTable" class="table table-bordered audit-check-table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Reference</th>
                            <th>Audit Questions/Statement</th>
                            <th>Audit Findings</th>
                            <th>Objective Evidence</th>
                            <th>Note</th>
                            <th>Attachment</th>
                        </tr>
                    </thead>
                    <tbody id="auditTableBody">
                        <!-- Default Row -->
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

@include('include.footer')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const auditData = JSON.parse(sessionStorage.getItem('auditData')) || [];
        const auditTableBody = document.getElementById('auditTableBody');

        // Jika auditData kosong, tambahkan satu baris default
        if (auditData.length === 0) {
            addNewRow();
        } else {
            // Jika ada data di sessionStorage, muat data ke tabel
            auditTableBody.innerHTML = '';
            auditData.forEach(data => {
                let newRow = createRow(data);
                auditTableBody.insertAdjacentHTML('beforeend', newRow);
            });
        }

        // Fungsi untuk membuat baris tabel
        function createRow(data = {}) {
            return `
                <tr>
                    <td><input type="text" name="reference[]" class="form-control" value="${data.reference || ''}"></td>
                    <td><input type="text" name="question[]" class="form-control" value="${data.question || ''}"></td>
                    <td>
                        <select name="findings[]" class="form-control">
                            <option value="COMPLIANT" ${data.findings === 'COMPLIANT' ? 'selected' : ''}>COMPLIANT</option>
                            <option value="OFI" ${data.findings === 'OFI' ? 'selected' : ''}>OFI</option>
                            <option value="MAJOR NC" ${data.findings === 'MAJOR NC' ? 'selected' : ''}>MAJOR NC</option>
                            <option value="MINOR NC" ${data.findings === 'MINOR NC' ? 'selected' : ''}>MINOR NC</option>
                        </select>
                    </td>
                    <td><input type="text" name="evidence[]" class="form-control" value="${data.evidence || ''}"></td>
                    <td><input type="text" name="note[]" class="form-control" value="${data.note || ''}"></td>
                    <td><input type="file" name="attachment[]" class="form-control-file"></td>
                </tr>
            `;
        }

        // Fungsi untuk menambahkan baris baru
        function addNewRow() {
            const newRow = createRow();
            auditTableBody.insertAdjacentHTML('beforeend', newRow);
        }

        // Event listener untuk tombol Add
        document.getElementById('add-button').addEventListener('click', function(e) {
            e.preventDefault();
            addNewRow();
        });


        // Fungsi untuk menyimpan data valid ke sessionStorage
        function saveToSessionStorage() {
            const rows = document.querySelectorAll('#auditTableBody tr');
            const auditDataArray = Array.from(rows).map(row => {
                const reference = row.querySelector('input[name="reference[]"]').value.trim();
                const question = row.querySelector('input[name="question[]"]').value.trim();

                // Hanya simpan jika kolom Reference dan Question tidak kosong
                if (reference && question) {
                    return {
                        reference,
                        question,
                        findings: row.querySelector('select[name="findings[]"]').value,
                        evidence: row.querySelector('input[name="evidence[]"]').value,
                        note: row.querySelector('input[name="note[]"]').value
                    };
                }
                return null; // Jika kosong, tidak disimpan
            }).filter(row => row !== null); // Hapus elemen null

            sessionStorage.setItem('auditData', JSON.stringify(auditDataArray));
        }

        // Simpan data ke sessionStorage saat tombol Save ditekan
        document.getElementById('save-button').addEventListener('click', function(e) {
            e.preventDefault();
            saveToSessionStorage();
            window.history.back();

        });

        // Simpan data ke sessionStorage saat tombol Back ditekan
        document.getElementById('back-button').addEventListener('click', function(e) {
            e.preventDefault();
            saveToSessionStorage();
            window.history.back();
        });
    });
</script>

@endsection