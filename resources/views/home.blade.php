@extends('layouts.admin')

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{-- xử lí thông báo --}}
<script>
  // Lắng nghe sự kiện click vào biểu tượng thông báo
  document.getElementById('notificationIcon').addEventListener('click', function() {
    // Hiển thị thông tin trong một cửa sổ pop-up hoặc thông báo
    alert('You have a new notification');
    // Hoặc bạn có thể hiển thị thông tin trong một phần tử HTML khác bằng cách thay đổi nội dung của phần tử đó
    // Ví dụ: document.getElementById('notificationContent').innerText = 'You have a new notification';
  });
</script>


<script>
  
           $(function() {
            // Xử lý sự kiện click của nút "Add item"
    $('#addTaskButton').click(function() {
      $('#addTaskModal').modal('show'); // Hiển thị modal khi nút "Add item" được click
    });

             // Lấy dữ liệu phần trăm công việc từ máy chủ hoặc các nguồn khác
             var taskData = [
               { label: 'Đã hoàn thành', percent: 60, color: '#28a745' },
               { label: 'Đang làm', percent: 30, color: '#ffc107' },
               { label: 'Chưa bắt đầu', percent: 10, color: '#dc3545' }
             ];
        
             // Tạo biểu đồ hình tròn
             var ctx = document.getElementById('taskChart').getContext('2d');
             var taskChart = new Chart(ctx, {
               type: 'pie',
               data: {
                 datasets: [{
                   data: taskData.map(item => item.percent),
                   backgroundColor: taskData.map(item => item.color)
                 }],
                 labels: taskData.map(item => item.label)
               },
              options: {
                legend: {
                  position: 'bottom'
                },
                tooltips: {
                  callbacks: {
                    label: function(tooltipItem, data) {
                      var dataset = data.datasets[tooltipItem.datasetIndex];
                      var label = data.labels[tooltipItem.index];
              var percent = dataset.data[tooltipItem.index];
              return label + ': ' + percent + '%';
            }
          }
        }
      }
    });
  });
</script>

{{-- // xử lí biểu đồ cột --}}
<script>
  // Lấy dữ liệu tiến độ công việc từ máy chủ hoặc nguồn dữ liệu khác
  var progressData = {
    labels: ['Task 1', 'Task 2', 'Task 3', 'Task 4'],
    datasets: [{
      label: 'Progress',
      data: [70, 50, 30, 80],
      backgroundColor: '#36a2eb'
    }]
  };

  // Tạo biểu đồ cột
  var ctx = document.getElementById('columnChart').getContext('2d');
  var columnChart = new Chart(ctx, {
    type: 'bar',
    data: progressData,
    options: {
      scales: {
        y: {
          beginAtZero: true,
          max: 100,
          ticks: {
            stepSize: 10
          }
        }
      }
    }
  });
</script>

<script>
  // Lắng nghe sự kiện nhấp chuột vào nút "Download Chart"
  document.getElementById('downloadChartButton').addEventListener('click', function() {
    // Lấy tham chiếu đến phần tử canvas
    var canvas = document.getElementById('columnChart');

    // Tạo URL dữ liệu từ canvas
    var imageURL = canvas.toDataURL('image/png');

    // Tạo một phần tử a để tải xuống ảnh
    var downloadLink = document.createElement('a');
    downloadLink.href = imageURL;
    downloadLink.download = 'chart.png';

    // Bấm vào phần tử a để tải xuống ảnh
    downloadLink.click();
  });
</script>

@endsection


@section('style')

<style>
  /* CSS to make the text fade when checkbox is checked */
  input[type="checkbox"]:checked + label {
    opacity: 0.5;
  }
</style>

<style>
  .card-title {
    margin-bottom: 20px;
  }

/* // xử lí hình ảnh */
  .container {
  position: relative;

}

.copy {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  color: white;
  font-size: 24px;
  font-weight: bold;
}
</style>

  



  
@endsection




@section('content')
<div class="copy" style="color :blue">
  <h3>Vì một cuộc sống tốt đẹp hơn cho mọi người</h3>
</div>
<div class="container">
  <img class="img" width="1000" height="700" src="https://ircdn.vingroup.net/storage/Uploads/Photos/Landmark81banner.jpg">
 
</div>
<form>
<div class="row">
  
  <h1 class="card-title" >
    <i class="ion ion-clipboard mr-1"></i>
    My Tasks
  </h1>
</div>
</form>



{{-- //Biểu đồ phần trăm cá nhân --}}

<div class="row" >
  <div class="col-4">
    <div class="card">
      <div class="card-header border-transparent">
        <h3 class="card-title">Total Task</h3>
      </div>
      <div class="card-body p-0">
        <canvas id="taskChart"></canvas>
      </div>
      </div>
  </div>

  {{-- //Biểu đồ cột --}}
 
  <div class="col-8">
    <div class="card">
      <div class="card-header border-transparent d-flex justify-content-between align-items-center">
        <h3 class="card-title">Progress</h3>
        <button id="downloadChartButton" class="btn btn-primary">Download</button>
      </div>
      <div class="card-body p-0">
        <canvas id="columnChart"></canvas>
      </div>
    </div>
  </div>
  

<div class="row" >

  {{-- <-----> --}}
  <div class="col-6">
<!-- TO DO List -->
<div class="card" >
    <div class="card-header" >
      <h3 class="card-title" >
        <i class="ion ion-clipboard mr-1"></i>
        To Do List
      </h3>

    
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <ul class="todo-list" data-widget="todo-list">
        <li>
          <!-- drag handle -->
          <span class="tools">
            <i class="fas fa-edit"></i>
            <i class="fas fa-trash-o"></i>
        </span>
          <!-- checkbox -->
          <div  class="icheck-primary d-inline ml-2">
            <input type="checkbox" value="" name="todo1" id="todoCheck1">
            <label for="todoCheck1"></label>
          </div>
          <!-- todo text -->
          <span class="text">Nghiên cứu tốt nghiệp 1</span>
          <!-- Emphasis label -->
          <small class="badge badge-danger"><i class="far fa-clock"></i> 2 mins</small>
          <!-- General tools such as edit or delete-->
          
        </li>
        <li>
            <span class="tools">
                <i class="fas fa-edit"></i>
                <i class="fas fa-trash-o"></i>
            </span>
          <div  class="icheck-primary d-inline ml-2">
            <input type="checkbox" value="" name="todo2" id="todoCheck2" checked>
            <label for="todoCheck2"></label>
          </div>
          <span class="text">Tham gia jobfair tháng 9</span>
          <small class="badge badge-info"><i class="far fa-clock"></i> 4 hours</small>
          
        </li>
        <li>
            <span class="tools">
                <i class="fas fa-edit"></i>
                <i class="fas fa-trash-o"></i>
            </span>
          <div  class="icheck-primary d-inline ml-2">
            <input type="checkbox" value="" name="todo3" id="todoCheck3">
            <label for="todoCheck3"></label>
          </div>
          <span class="text">Thực tập TTM từ tháng 7 - 9</span>
          <small class="badge badge-warning"><i class="far fa-clock"></i> 1 day</small>
         
        </li>
        <li>
            <span class="tools">
                <i class="fas fa-edit"></i>
                <i class="fas fa-trash-o"></i>
            </span>
          <div  class="icheck-primary d-inline ml-2">
            <input type="checkbox" value="" name="todo4" id="todoCheck4">
            <label for="todoCheck4"></label>
          </div>
          <span class="text"> Bảo vệ ITSS tuần sau </span>
          <small class="badge badge-success"><i class="far fa-clock"></i> 3 days</small>
          
        </li>
        <li>
            <span class="tools">
                <i class="fas fa-edit"></i>
                <i class="fas fa-trash-o"></i>
            </span>
          <div  class="icheck-primary d-inline ml-2">
            <input type="checkbox" value="" name="todo5" id="todoCheck5">
            <label for="todoCheck5"></label>
          </div>
          <span class="text">Ôn thi jlpt</span>
          <small class="badge badge-primary"><i class="far fa-clock"></i> 1 week</small>
          
        </li>
        <li>
            <span class="tools">
                <i class="fas fa-edit"></i>
                <i class="fas fa-trash-o"></i>
            </span>
          <div  class="icheck-primary d-inline ml-2">
            <input type="checkbox" value="" name="todo6" id="todoCheck6">
            <label for="todoCheck6"></label>
          </div>
          <span class="text">CN figbug KTPM</span>
          <small class="badge badge-secondary"><i class="far fa-clock"></i> 1 month</small>
          
        </li>
      </ul>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
      <button type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add item</button>
    </div>
    <!-- Modal thêm task -->
<div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addTaskModalLabel">Add Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Các trường thông tin cho task mới -->
        <div class="form-group">
          <label for="taskName">Task Name</label>
          <input type="text" class="form-control" id="taskName" placeholder="Enter task name">
        </div>
        <div class="form-group">
          <label for="taskDescription">Description</label>
          <textarea class="form-control" id="taskDescription" rows="3" placeholder="Enter task description"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="addTaskButton">Add</button>
      </div>
    </div>
  </div>
</div>
  </div>
</div>

<div class="col-6">
  <div class="card">
    <div class="card-header">
      <h2 class="card-title">Project Team</h2>
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>Task</th>
            <th>Progress</th>
            <th style="width: 40px">Label</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1.</td>
            <td>Team UI UX</td>
            <td>
              <div class="progress progress-xs">
                <div class="progress-bar bg-danger" style="width: 55%"></div>
              </div>
            </td>
            <td><span class="badge bg-danger">55%</span></td>
          </tr>
          <tr>
            <td>2.</td>
            <td>Team ITSS</td>
            <td>
              <div class="progress progress-xs">
                <div class="progress-bar bg-warning" style="width: 70%"></div>
              </div>
            </td>
            <td><span class="badge bg-warning">70%</span></td>
          </tr>
          <tr>
            <td>3.</td>
            <td>Team AI</td>
            <td>
              <div class="progress progress-xs progress-striped active">
                <div class="progress-bar bg-primary" style="width: 30%"></div>
              </div>
            </td>
            <td><span class="badge bg-primary">30%</span></td>
          </tr>
          <tr>
            <td>4.</td>
            <td>Team KTPM</td>
            <td>
              <div class="progress progress-xs progress-striped active">
                <div class="progress-bar bg-success" style="width: 90%"></div>
              </div>
            </td>
            <td><span class="badge bg-success">90%</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

{{-- <Bảng progress> --}}
<div class="col-6">
  <!-- TABLE: LATEST ORDERS -->
  <div class="card">
    <div class="card-header border-transparent">
      <h3 class="card-title">Progress</h3>

     
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table m-0">
          <thead>
          <tr>
            <th>ID</th>
            <th>Task</th>
            <th>Priority</th>
            <th>Note</th>
          </tr>
          </thead>
          <tbody>
          
          <tr>
            <td><a href="pages/examples/invoice.html">1</a></td>
            <td>Project 1</td>
            <td><span class="badge badge-warning">Medium</span></td>
            <td>
              <div class="sparkbar" data-color="#f39c12" data-height="20">Cần hoàn thiện dashboard</div>
            </td>
          </tr>
          <tr>
            <td><a href="pages/examples/invoice.html">2</a></td>
            <td>AI</td>
            <td><span class="badge badge-danger">High</span></td>
            <td>
              <div class="sparkbar" data-color="#f56954" data-height="20">Tìm hiểu thuật toán alpha-beta</div>
            </td>
          </tr>
          <tr>
            <td><a href="pages/examples/invoice.html">2</a></td>
            <td>Tiếng nhật 6</td>
            <td><span class="badge badge-success">Low</span></td>
            <td>
              <div class="sparkbar" data-color="#00a65a" data-height="20">Học choukai, dokkai</div>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.table-responsive -->
    </div>
</div>
</div>
  <!-- /.card -->

<!-- Bảng Project Team -->






          
@endsection

