@extends('layouts.admin')

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
            <th style="width: 2cm">Deadline</th>
            <th style="width: 2cm">Owner</th>
            <th style="width: 2cm"></th>
 
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
        </div>
      </div>
    </div>
  </div>
@endsection

