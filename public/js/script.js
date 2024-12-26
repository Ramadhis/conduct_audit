// Toggle the sidebar
document.getElementById("menu-toggle").onclick = function () {
    document.getElementById("sidebar").classList.toggle("show");
    document.getElementById("page-content").classList.toggle("slide");
};

// Close button functionality
document.getElementById("menu-close").onclick = function () {
    document.getElementById("sidebar").classList.remove("show");
    document.getElementById("page-content").classList.remove("slide");
};

function showTab(tabId) {
    document.querySelectorAll('.tab-content').forEach(tab => tab.style.display = 'none');
    document.querySelectorAll('.btn-group .btn').forEach(button => button.classList.remove('active'));
    document.getElementById(tabId).style.display = 'block';
    event.target.classList.add('active');
}
function addContainmentRow() {
    const table = document.getElementById('containmentActionTable');
    const row = table.insertRow();
    row.innerHTML = `
        <td><input type="text" class="form-control" name="containment_action[]"></td>
        <td><input type="file" class="form-control" name="containment_evidence[]"></td>
        <td><input type="text" class="form-control" name="containment_responsible[]"></td>
        <td><input type="date" class="form-control" name="containment_ecd[]"></td>
    `;
}

function addCorrectiveRow() {
    const table = document.getElementById('correctiveActionTable');
    const row = table.insertRow();
    row.innerHTML = `
        <td><input type="text" class="form-control" name="corrective_action[]"></td>
        <td><input type="file" class="form-control" name="corrective_evidence[]"></td>
        <td><input type="text" class="form-control" name="corrective_responsible[]"></td>
        <td><input type="date" class="form-control" name="corrective_ecd[]"></td>
    `;
}

