@extends('layouts.admin')

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-o7YsQoyWTbNCOSn8IHrp0ba/JpRIlQkOenGGCYGmN4c=" crossorigin="anonymous"></script>
<script>
    // Xử lý sự kiện nhập từ khóa vào thanh tìm kiếm
    document.getElementById('searchInput').addEventListener('keyup', function() {
      var input, filter, table, tr, td, i, txtValue;
      input = this;
      filter = input.value.toUpperCase();
      table = document.querySelector('.table.table-bordered');
      tr = table.getElementsByTagName('tr');
  
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName('td')[1]; // Cột dữ liệu cần tìm kiếm (ở đây là cột Task)
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = '';
          } else {
            tr[i].style.display = 'none';
          }
        }
      }
    });
  
   
  </script>

    <script>
// Xử lý sự kiện click vào nút "Update" trong modal
document.getElementById('updateDataConfirmButton').addEventListener('click', function() {
  // Lấy giá trị từ các trường thông tin trong form
  var taskName = document.getElementById('taskName').value;
  var progress = document.getElementById('progress').value;
  var label = document.getElementById('label').value;
  var deadline = document.getElementById('deadline').value;
  var owner = document.getElementById('owner').value;

  // Lấy thông tin dòng cần cập nhật
  var rowToUpdate = document.querySelector('.table.table-bordered tbody tr.editing');
  rowToUpdate.cells[1].textContent = taskName;
  rowToUpdate.cells[3].textContent = progress + '%';
  rowToUpdate.cells[4].textContent = deadline;
  rowToUpdate.cells[5].textContent = owner;

   // Cập nhật lại class và nội dung của label và progress bar
  updateLabelAndProgressBar(rowToUpdate.cells[2], progress);
  // Sau khi cập nhật dữ liệu thành công, đóng modal và hiển thị nút "Add" lại
  $('#addDataModal').modal('hide');
  document.getElementById('addDataConfirmButton').style.display = 'block';
  document.getElementById('updateDataConfirmButton').style.display = 'none';
});


document.addEventListener('click', function(event) {
    var target = event.target;
    if (target.tagName === 'BUTTON') {
      var action = target.getAttribute('data-action'); // Lấy action của nút (delete hoặc edit)
      if (action === 'delete') {
        // Xóa dòng tương ứng khi click vào nút "Delete"
        var row = target.closest('tr');
        row.remove();
      } else if (action === 'edit') {
        // Hiển thị thông tin dòng tương ứng trong modal khi click vào nút "Edit"
        var row = target.closest('tr');
        var taskName = row.cells[1].textContent;
        var progress = row.cells[3].textContent.replace('%', '');
        var deadline = row.cells[4].textContent;
        var owner = row.cells[5].textContent;
        
        document.getElementById('taskName').value = taskName;
        document.getElementById('progress').value = progress;
        document.getElementById('deadline').value = deadline;
        document.getElementById('owner').value = owner;
  
        // Thêm class "editing" vào dòng đang được chỉnh sửa
        var editingRow = document.querySelector('.table.table-bordered tbody tr.editing');
        if (editingRow) {
          editingRow.classList.remove('editing');
        }
        row.classList.add('editing');
  
        $('#addDataModal').modal('show');
        document.getElementById('addDataConfirmButton').style.display = 'none';
        document.getElementById('updateDataConfirmButton').style.display = 'block';
      }
    }
  });
  
  </script>
  
<script>
     // Hàm để tạo các nút "Delete" và "Edit" cho hàng mới được thêm vào bảng
function createDeleteEditButtons(row) {
    var tdAction = document.createElement('td');

    tdAction.innerHTML = `
        <button class="btn btn-success btn-sm" data-action="member" data-toggle="modal" data-target="#memberModal">Click</button>
        <button class="btn btn-danger btn-sm" data-action="delete">Delete</button>
        <button class="btn btn-primary btn-sm" data-action="edit">Edit</button>
    `;

    row.appendChild(tdAction);
}
    // Xử lý sự kiện click vào nút "Add Data" trong modal
    document.getElementById('addDataConfirmButton').addEventListener('click', function() {
      // Lấy giá trị từ các trường thông tin trong form
      var taskName = document.getElementById('taskName').value;
      var progress = document.getElementById('progress').value;
      var label = document.getElementById('label').value;
      var deadline = document.getElementById('deadline').value;
      var owner = document.getElementById('owner').value;
  
      // Tạo thẻ <tr> mới để thêm vào bảng
      var newRow = document.createElement('tr');
  
      // Tạo các thẻ <td> mới để thêm vào thẻ <tr>
      var tdNumber = document.createElement('td');
      var tdTaskName = document.createElement('td');
      var tdProgress = document.createElement('td');
      var tdLabel = document.createElement('td');
      var tdDeadline = document.createElement('td');
      var tdOwner = document.createElement('td');
  
      // Gán nội dung cho các thẻ <td> mới
      tdNumber.textContent = '5.'; // Số thứ tự có thể tự tăng tùy ý
      tdTaskName.textContent = taskName;
      tdProgress.innerHTML = `
        <div class="progress progress-xs">
          <div class="progress-bar bg-primary" style="width: ${progress}%"></div>
        </div>
      `;
      tdLabel.innerHTML = `<span class="badge bg-primary">${progress}%</span>`;
      tdDeadline.textContent = deadline;
      tdOwner.textContent = owner;
  
      // Thêm các thẻ <td> vào thẻ <tr>
      newRow.appendChild(tdNumber);
      newRow.appendChild(tdTaskName);
      newRow.appendChild(tdProgress);
      newRow.appendChild(tdLabel);
      newRow.appendChild(tdDeadline);
      newRow.appendChild(tdOwner);
  
      // Thêm thẻ <tr> mới vào bảng
      var tableBody = document.querySelector('.table.table-bordered tbody');
      tableBody.appendChild(newRow);
  
      // Sau khi thêm dữ liệu thành công, đóng modal
      $('#addDataModal').modal('hide');
    });
  </script>

<script>
   document.addEventListener('click', function(event) {
  var target = event.target;
  if (target.tagName === 'BUTTON') {
    var action = target.getAttribute('data-action'); // Lấy action của nút (delete hoặc edit)
    if (action === 'delete') {
      // Xóa dòng tương ứng khi click vào nút "Delete"
      var row = target.closest('tr');
      row.remove();
    } else if (action === 'edit') {
      // Hiển thị thông tin dòng tương ứng trong modal khi click vào nút "Edit"
      var row = target.closest('tr');
      var taskName = row.cells[1].textContent;
      var progress = row.cells[3].textContent.replace('%', '');
      var deadline = row.cells[4].textContent;
      var owner = row.cells[5].textContent;
      
      document.getElementById('taskName').value = taskName;
      document.getElementById('progress').value = progress;
      document.getElementById('deadline').value = deadline;
      document.getElementById('owner').value = owner;
      $('#addDataModal').modal('show');
    }
  }
});

  </script>


  {{-- // update label khi update thông tin --}}
  <script>
    function updateLabelAndProgressBar(cell, progress) {
  cell.innerHTML = `
    <div class="progress progress-xs">
      <div class="progress-bar bg-${progressColor(progress)}" style="width: ${progress}%"></div>
    </div>
  `;
  var labelCell = cell.nextElementSibling;
  labelCell.innerHTML = `<span class="badge bg-${progressColor(progress)}">${progress}%</span>`;
}

function progressColor(progress) {
  if (progress >= 90) {
    return 'success';
  } else if (progress >= 70) {
    return 'warning';
  } else {
    return 'danger';
  }
}

  </script>

   {{-- xu li modal click --}}
   <script>
    // Xử lý sự kiện khi click vào nút "Click" trong cột "Member"
    document.addEventListener('click', function (event) {
        var target = event.target;
        if (target.tagName === 'BUTTON' && target.getAttribute('data-action') === 'member') {
            // Lấy thông tin thành viên từ dòng tương ứng
            var row = target.closest('tr');
            var memberName = row.cells[5].textContent;
            var memberTask = row.cells[1].textContent;
            var memberNote = row.cells[2].textContent;
            
            // Gán thông tin thành viên vào các trường trong modal
            document.getElementById('memberName').value = memberName;
            document.getElementById('memberTask').value = memberTask;
            document.getElementById('memberNote').value = memberNote;
            
            // Hiển thị modal
            $('#memberModal').modal('show');
        }
    });

    // Xử lý sự kiện khi click vào nút "Cập nhật" trong modal thành viên
    document.getElementById('updateMemberButton').addEventListener('click', function () {
        // Lấy giá trị từ các trường thông tin trong modal
        var memberTask = document.getElementById('memberTask').value;
        var memberNote = document.getElementById('memberNote').value;

        // Lấy dòng đang chỉnh sửa
        var editingRow = document.querySelector('.table.table-bordered tbody tr.editing');
        if (editingRow) {
            // Cập nhật thông tin thành viên trong dòng đang chỉnh sửa
            editingRow.cells[1].textContent = memberTask;
            editingRow.cells[2].textContent = memberNote;
        }

        // Sau khi cập nhật thông tin thành viên, đóng modal
        $('#memberModal').modal('hide');
    });
</script>


<script>
    // Hàm để làm mới (reset) modal sau khi cập nhật thành công
    function resetMemberModal() {
        document.getElementById('memberForm').reset();
    }
</script>
<script>
    // Xử lý sự kiện khi click vào nút "Cập nhật" trong modal thành viên
    document.getElementById('updateMemberButton').addEventListener('click', function () {
        // Lấy giá trị từ các trường thông tin trong modal
        var memberTask = document.getElementById('memberTask').value;
        var memberNote = document.getElementById('memberNote').value;

        // Lấy dòng đang chỉnh sửa
        var editingRow = document.querySelector('.table.table-bordered tbody tr.editing');
        if (editingRow) {
            // Cập nhật thông tin thành viên trong dòng đang chỉnh sửa
            editingRow.cells[1].textContent = memberTask;
            editingRow.cells[2].textContent = memberNote;
        }

        // Sau khi cập nhật thông tin thành viên, đóng modal và làm mới (reset) modal
        $('#memberModal').modal('hide');
        resetMemberModal();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
      // Dữ liệu từ bảng project team (số tiến độ)
      var progressData = [55, 70, 30, 90, 100];
      // Màu sắc tương ứng với cột label
      var labelColors = ['red', 'orange', 'blue', 'green'];
  
      // Tạo biểu đồ cột
      var ctx = document.getElementById('columnChart').getContext('2d');
      var columnChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['UI UX', 'ITSS', 'AI', 'KTPM'],
          datasets: [{
            data: progressData,
            backgroundColor: labelColors, // Sử dụng màu sắc tương ứng với cột label
          }]
        },
        options: {
          responsive: true,
          legend: {
            display: false // Ẩn legend nếu không cần thiết
          },
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true,
                max: 100 // Đặt giá trị tối đa cho trục Oy là 100
              }
            }]
          }
        }
      });
    });
  </script>
  
  
  {{-- Xử lí phần ghi chú --}}
 <script>
    // Biến để lưu chỉ mục của dòng đang được chỉnh sửa
let editingRowIndex = -1;

// Xử lý sự kiện khi ấn nút "Add Note" để hiển thị modal thêm ghi chú
document.getElementById('addNoteButton').addEventListener('click', function() {
  $('#noteModal').modal('show');
  // Xóa nội dung textarea trong modal để nhập ghi chú mới
  document.getElementById('noteContent').value = '';
});

// Xử lý sự kiện khi ấn nút "Save" trong modal để thêm ghi chú vào bảng "Notes"
document.getElementById('saveNoteButton').addEventListener('click', function() {
  // Lấy nội dung ghi chú từ textarea trong modal
  var noteContent = document.getElementById('noteContent').value;

  // Tạo thẻ <tr> mới để thêm vào bảng
  var newRow = document.createElement('tr');

  // Tạo các thẻ <td> mới để thêm vào thẻ <tr>
  var tdNumber = document.createElement('td');
  var tdNote = document.createElement('td');
  var tdAction = document.createElement('td');

  // Gán nội dung cho các thẻ <td> mới
  tdNumber.textContent = getNextNoteNumber(); // Số thứ tự có thể tự tăng tùy ý
  tdNote.textContent = noteContent;

  // Tạo các nút "Edit" và "Delete" cho cột "Action"
  var editButton = document.createElement('button');
  editButton.textContent = 'Edit';
  editButton.className = 'btn btn-primary btn-sm';
  editButton.dataset.action = 'edit';

  var deleteButton = document.createElement('button');
  deleteButton.textContent = 'Delete';
  deleteButton.className = 'btn btn-danger btn-sm';
  deleteButton.dataset.action = 'delete';

  // Gán sự kiện cho nút "Edit" và "Delete"
  editButton.addEventListener('click', function() {
    editNote(tdNote.textContent);
  });

  deleteButton.addEventListener('click', function() {
    deleteNote(tdNumber.textContent);
  });

  // Thêm các nút vào cột "Action"
  tdAction.appendChild(editButton);
  tdAction.appendChild(deleteButton);

  // Thêm các thẻ <td> vào thẻ <tr>
  newRow.appendChild(tdNumber);
  newRow.appendChild(tdNote);
  newRow.appendChild(tdAction);

  // Thêm dòng mới vào bảng "Notes"
  document.getElementById('noteTable').appendChild(newRow);

  // Đóng modal sau khi thêm ghi chú
  $('#noteModal').modal('hide');
});

// Hàm để lấy số thứ tự tiếp theo cho ghi chú
function getNextNoteNumber() {
  var lastRow = document.getElementById('noteTable').rows.length;
  return lastRow;
}

// Xử lý sự kiện khi ấn nút "Edit" để hiển thị modal cập nhật dữ liệu
function editNote(noteContent) {
  // Lấy chỉ mục của dòng đang được chỉnh sửa
  editingRowIndex = Array.from(document.getElementById('noteTable').rows).findIndex(row => row.cells[1].textContent === noteContent);

  // Hiển thị modal cùng với nội dung ghi chú cần sửa
  $('#noteModal').modal('show');
  document.getElementById('noteContent').value = noteContent;
}

// Xử lý sự kiện khi ấn nút "Update" trong modal để cập nhật ghi chú trong bảng "Notes"
document.getElementById('updateNoteButton').addEventListener('click', function() {
  // Lấy nội dung ghi chú từ textarea trong modal
  var noteContent = document.getElementById('noteContent').value;

  // Cập nhật nội dung ghi chú trong bảng
  var table = document.getElementById('noteTable');
  table.rows[editingRowIndex].cells[1].textContent = noteContent;

  // Đóng modal sau khi cập nhật ghi chú
  $('#noteModal').modal('hide');
});

// Xử lý sự kiện khi ấn nút "Delete" để xóa ghi chú khỏi bảng "Notes"
function deleteNote(noteNumber) {
  if (confirm('Are you sure you want to delete this note?')) {
    var table = document.getElementById('noteTable');
    var rowIndexToDelete = Array.from(table.rows).findIndex(row => row.cells[0].textContent === noteNumber);

    // Xóa dòng khỏi bảng
    table.deleteRow(rowIndexToDelete);
  }
}

 </script>
  
  
  
@endsection


@section('style')

@section('content')


{{-- // Tìm kiếm --}}
<form>
    <div class="row">
      <h1 class="card-title">
        <i class="ion ion-clipboard mr-1"></i>
        My team list
      </h1>
      <div class="col-md-4 ml-auto">
        <div class="input-group">
          <input type="text" id="searchInput" class="form-control" placeholder="Search...">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button" id="addDataButton" data-toggle="modal" data-target="#addDataModal">
              Add Data
            </button>
          </div>
        </div>
      </div>
    </div>
  </form>
{{-- //kết thúc tìm kiếm --}}


<div class="col-12">
  <div class="card">
    <div class="card-header">
      <h2 class="card-title">Project Team</h2>
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 1cm">#</th>
            <th style="width: 40px">Task</th>
            <th style="width: 40px" >Progress</th>
            <th style="width: 40px">Label</th>
            <th style="width: 3cm">Deadline</th>
            <th style="width: 2cm">Leader</th>
            <th style="width: 1cm">Member</th>
            <th style="width: 4cm">Action</th>
 
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1.</td>
            <td>UI UX</td>
            <td>
              <div class="progress progress-xs">
                <div class="progress-bar bg-danger" style="width: 55%"></div>
              </div>
            </td>
            <td><span class="badge bg-danger">55%</span></td>
            <td>01/05 - 14/05</td>
            <td>Hoan TV</td>
            <td>
                <button class="btn btn-success btn-sm" data-action="member" data-toggle="modal" data-target="#memberModal">Click</button>

            </td>
            <td> 
                <button class="btn btn-danger btn-sm" data-action="delete">Delete</button> <!-- Nút Delete -->
                <button class="btn btn-primary btn-sm" data-action="edit">Edit</button> <!-- Nút Edit -->
            </td>

          </tr>
          <tr>
            <td>2.</td>
            <td>ITSS</td>
            <td>
              <div class="progress progress-xs">
                <div class="progress-bar bg-warning" style="width: 70%"></div>
              </div>
            </td>
            <td><span class="badge bg-warning">70%</span></td>
            <td>15/05 - 30/05</td>
            <td> MV Khánh </td>
            <td>
                <button class="btn btn-success btn-sm" data-action="member" data-toggle="modal" data-target="#memberModal">Click</button>

            </td>
            <td>
                <button class="btn btn-danger btn-sm" data-action="delete">Delete</button> <!-- Nút Delete -->
                <button class="btn btn-primary btn-sm" data-action="edit">Edit</button> <!-- Nút Edit --> </td>
          </tr>
          <tr>
            <td>3.</td>
            <td>AI</td>
            <td>
              <div class="progress progress-xs progress-striped active">
                <div class="progress-bar bg-primary" style="width: 30%"></div>
              </div>
            </td>
            <td><span class="badge bg-primary">30%</span></td>
            <td>15/07 - 30/07</td>
            <td> VM Đăng</td>
            <td>
                <button class="btn btn-success btn-sm" data-action="member" data-toggle="modal" data-target="#memberModal">Click</button>
            </td>
            <td> 
                <button class="btn btn-danger btn-sm" data-action="delete">Delete</button> <!-- Nút Delete -->
                <button class="btn btn-primary btn-sm" data-action="edit">Edit</button> <!-- Nút Edit -->
            </td>
          </tr>
          <tr>
            <td>4.</td>
            <td>KTPM</td>
            <td>
              <div class="progress progress-xs progress-striped active">
                <div class="progress-bar bg-success" style="width: 90%"></div>
              </div>
            </td>
            <td><span class="badge bg-success">90%</span></td>
            <td> 01/07 - 30/07</td>
            <td> Hùng ND</td>
            <td>
                <button class="btn btn-success btn-sm" data-action="member" data-toggle="modal" data-target="#memberModal">Click</button>
            </td>
            <td>
                <button class="btn btn-danger btn-sm" data-action="delete">Delete</button> <!-- Nút Delete -->
                <button class="btn btn-primary btn-sm" data-action="edit">Edit</button> <!-- Nút Edit --> </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
   
    <!-- Modal để thêm dữ liệu -->
<div class="modal fade" id="addDataModal" tabindex="-1" role="dialog" aria-labelledby="addDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addDataModalLabel">Add Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Các trường thông tin cho dữ liệu mới -->
          <form id="addDataForm">
            <div class="form-group">
              <label for="taskName">Task Name</label>
              <input type="text" class="form-control" id="taskName" name="taskName" placeholder="Enter task name">
            </div>
            <div class="form-group">
              <label for="progress">Progress</label>
              <input type="number" class="form-control" id="progress" name="progress" placeholder="Enter progress percentage">
            </div>
            <div class="form-group">
              <label for="label">Label</label>
              <input type="text" class="form-control" id="label" name="label" placeholder="Enter label">
            </div>
            <div class="form-group">
              <label for="deadline">Deadline</label>
              <input type="text" class="form-control" id="deadline" name="deadline" placeholder="Enter deadline">
            </div>
            <div class="form-group">
              <label for="owner">Owner</label>
              <input type="text" class="form-control" id="owner" name="owner" placeholder="Enter owner">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" id="addDataConfirmButton">Add</button>
         <!-- Thêm nút "Update" để xử lý việc cập nhật dữ liệu đã chỉnh sửa -->
          <button type="button" class="btn btn-success" id="updateDataConfirmButton" style="display:none;">Update</button>
        </div>
      </div>
    </div>
  </div>

  {{-- // xu li modal khi click  --}}
 
           <!-- Modal để hiển thị thông tin thành viên -->
<div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="memberModalLabel">Member Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Các trường thông tin cho thành viên -->
                <form id="memberForm">
                    <div class="form-group">
                        <label for="memberName">Tên thành viên</label>
                        <input type="text" class="form-control" id="memberName" name="Hoan TV Ngô VB" >
                    </div>
                    <div class="form-group">
                        <label for="memberTask">Nhiệm vụ</label>
                        <input type="text" class="form-control" id="memberTask" name="Thiết kế giao diện mẫu">
                    </div>
                    <div class="form-group">
                        <label for="memberNote">Note</label>
                        <textarea class="form-control" id="memberNote" name="memberNote"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="updateMemberButton">Cập nhật</button>
            </div>
        </div>
        
    </div>

</div>

<!-- Biểu đồ cùng hàng với bảng Notes -->
<div class="row">
    <div class="col-6">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Completion Percent</h3>
        </div>
        <div class="card-body">
          <canvas id="columnChart" width="400" height="200"></canvas>
        </div>
      </div>
    </div>
  
    <!-- Bảng ghi chú -->
    <div class="col-6">
      <div class="card">
        <div class="card-header">
          <h2 class="card-title">Notes</h2>
        </div>
        <div class="card-body">
          <table id="noteTable" class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Note</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>This is a note</td>
                <td>
                  <button class="btn btn-primary btn-sm" data-action="edit">Edit</button>
                  <button class="btn btn-danger btn-sm" data-action="delete">Delete</button>
                </td>
              </tr>
              <!-- Thêm các dòng ghi chú khác vào đây -->
            </tbody>
          </table>
          <button class="btn btn-success" id="addNoteButton" data-action="add">Add Note</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Modal để thêm và cập nhật dữ liệu -->
  <div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="noteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="noteModalLabel">Note Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="noteForm">
            <div class="form-group">
              <label for="noteContent">Note</label>
              <textarea class="form-control" id="noteContent" rows="3" placeholder="Enter your note"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" id="saveNoteButton">Save</button>
          <button type="button" class="btn btn-success" id="updateNoteButton">Update</button>
        </div>
      </div>
    </div>
  </div>
  
 

@endsection

