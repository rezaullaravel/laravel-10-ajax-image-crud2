<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Laravel ajax image crud</title>
  </head>
  <body>
   <div class="container mt-5">
     <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="alert alert-success" style="display: none;"></div>
            <div class="card">
                <div class="card-header">
                    <h4>Memeber List
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMemberModal">
                          Add Member
                          </button>
                    </h4>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Member Name</th>
                                <th>Phone</th>
                                <th>Photo</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                           @foreach ($members as $row)
                               <tr>
                                 <td>{{ $row->id }}</td>
                                 <td>{{ $row->name }}</td>
                                 <td>{{ $row->phone }}</td>
                                 <td>
                                    <img src="{{ asset($row->photo) }}" alt="" width="80" height="80">
                                 </td>
                                 <td>
                                    <button type="button" class="btn btn-success edit_member"
                                    data-id = {{ $row->id }}
                                    >Edit</button>
                                 </td>

                               </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
     </div>
   </div>

   {{-- add modal --}}
   <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="#" method="post" id="addMemberForm" enctype="multipart/form-data" >
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Member Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control">
                        {{-- <span id="nameErr" class="text-danger"></span> --}}
                </div>

                <div class="form-group">
                <label>Phone <span class="text-danger">*</span></label>
                <input type="text" name="phone" class="form-control">
                    {{-- <span id="phoneErr" class="text-danger"></span> --}}
                </div>

                <div class="form-group">
                <label>Photo<span class="text-danger">*</span></label>
                <input type="file" name="photo" class="form-control" onchange="memberImgUrl(this)">
                    {{-- <span id="photoErr" class="text-danger"></span> --}}
                <img src="" id="memberImage" style="margin-top: 5px;">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="addMemberBtn">Submit</button>
            </div>
    </form>
      </div>
    </div>
  </div>
   {{-- add modal end --}}

   {{-- edit modal --}}
   <div class="modal fade" id="editMemberModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="#" method="post" id="editMemberForm" enctype="multipart/form-data" >
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Member Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="e_name" class="form-control">
                    <input type="hidden" name="e_id" id="e_id" class="form-control">
                        {{-- <span id="nameErr" class="text-danger"></span> --}}
                </div>

                <div class="form-group">
                <label>Phone <span class="text-danger">*</span></label>
                <input type="text" name="phone" id="e_phone" class="form-control">
                    {{-- <span id="phoneErr" class="text-danger"></span> --}}
                </div>

                <div class="form-group">
                <label>Photo<span class="text-danger">*</span></label>
                <input type="file" name="photo" class="form-control" onchange="memberImgUrl2(this)">
                    {{-- <span id="photoErr" class="text-danger"></span> --}}
                <img src="" id="memberImage2" style="margin-top: 5px;">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary updateMemberBtn" >Update</button>
            </div>
    </form>
      </div>
    </div>
  </div>
   {{-- edit modal end --}}

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>

 {{-- javascript for    image preview--}}
 <script type="text/javascript">
    function memberImgUrl(input){
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e){
        $('#memberImage').attr('src',e.target.result).width(80).height(80);
        };
        reader.readAsDataURL(input.files[0]);
    }
    }
</script>
{{-- javascript for  image preview end --}}

{{-- javascript for    image preview during update--}}
<script type="text/javascript">
    function memberImgUrl2(input){
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e){
        $('#memberImage2').attr('src',e.target.result).width(80).height(80);
        };
        reader.readAsDataURL(input.files[0]);
    }
    }
</script>
{{-- javascript for  image preview end --}}



<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>



<script>
    $(document).ready(function(){
        $("#addMemberForm").submit(function(e){
            e.preventDefault();
            //alert('submitted');
            const formData = new FormData(this);


            $.ajax({
                url:"{{ route('member.store') }}",
                method:'POST',
                data:formData,
                cache:false,
                processData: false,
                contentType: false,
                success:function(response){
                 //alert('completed');
                 $('.alert').show();
                 $('.alert').html('Member added successfully');
                 $('#addMemberModal').modal('hide');
                 $('#addMemberForm')[0].reset();
                 $('#memberImage').attr('src','');
                 $('#memberImage').hide();
                 $('.table').load(location.href+' .table');
                },error:function(error){
                    console.log(error);
                },
            });
        });
    });
</script>

<script>
    $(document).on('click','.edit_member',function(e){
        e.preventDefault();

        $('#editMemberModal').modal('show');

        let id = $(this).data('id');
       // alert(id);
       $.ajax({
           url:"/edit/member/"+id,
           method:'GET',
           success:function(response){
            console.log(response);
            $('#e_name').val(response.member.name);
            $('#e_phone').val(response.member.phone);
            $('#e_id').val(id);

            //  var source = "{!! asset('response.member.photo') !!}";
            //  $('#memberImage2').attr('src', source);

           },
       });
    });
</script>

<script>
    $(document).on('click','.updateMemberBtn',function(e){
        e.preventDefault();
        let id = $('#e_id').val();

        let editFormData = new FormData($('#editMemberForm')[0]);

        $.ajax({
                url:"/update/member/"+id,
                method:'POST',
                data:editFormData,
                cache:false,
                processData: false,
                contentType: false,
                success:function(response){
                 //alert('completed');
                 $('.alert').show();
                 $('.alert').html('Member updated successfully');
                 $('#editMemberModal').modal('hide');
                 $('#editMemberForm')[0].reset();
                 $('#memberImage2').attr('src','');
                 $('#memberImage2').hide();
                 $('.table').load(window.location.href+' .table');
                 //window.location.reload();
                },
            });
    });
</script>








