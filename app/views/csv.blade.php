@extends('admin-template')
@section('admin-navigate-content')
<div class="bootstrap-iso">
<h1>import-data</h1>
<hr>
    <form method="post" enctype="multipart/form-data">
    	Select file csv to upload:
    	<input type="file" name="file_to_upload" id="file_to_upload">
    	<div id="upload-file" class="btn btn-default">Upload</div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></div>
                        <h4 class="modal-title" id="myModalLabel">import data into</h4>
                    </div>
                    <div class="modal-body">
                        <button class="btn btn-primary" name="model" value="chapter" style="width: 100%; margin-bottom: 10px">chapter</button>
                        <button class="btn btn-primary" name="model" value="question" style="width: 100%; margin-bottom: 10px">question</button>
                        <button class="btn btn-primary" name="model" value="option" style="width: 100%; margin-bottom: 10px">option</button>
                    </div>
                    <div class="modal-footer">
                        <div class="btn btn-default" data-dismiss="modal">Close</div>
                    </div>
                </div>
            </div>
        </div>
    </form>
<h1>export-data</h1>
<hr>
<form method="post">
    <button name="export-result" value="submit">export-result</button>
</form>
    @if(Session::has('data'))
        <pre><?php print_r(Session::get('data')); ?></pre>
    @endif
</div>
@endsection
@section('project_script')
<script>
    $(document).ready(function(){
        $('#upload-file').click(function(){
            if($('#file_to_upload').val() != ""){
                $('#myModal').modal('show');
            }else{
                alert('please choose a file');
            }
        });
    });
</script>
@endsection