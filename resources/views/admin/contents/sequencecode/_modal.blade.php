<!-- Modal -->

<div class="modal fade" id="myModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" id="formModal"
                      novalidate>
                    @csrf
                    <input type="hidden" name="id" id="id" class="id">

                       <div class='mb-3'>
                        <label class='form-label' for='sequence'>Sequence</label>
                        <input type='text' id='sequence' name='sequence' class='form-control' placeholder='Sequence'>
                    </div> <div class='mb-3'>
                        <label class='form-label' for='sequence_digit'>Sequence_digit</label>
                        <input type='text' id='sequence_digit' name='sequence_digit' class='form-control' placeholder='Sequence_digit'>
                    </div> <div class='mb-3'>
                        <label class='form-label' for='type'>Type</label>
                        <input type='text' id='type' name='type' class='form-control' placeholder='Type'>
                    </div> <div class='mb-3'>
                        <label class='form-label' for='prefix'>Prefix</label>
                        <input type='text' id='prefix' name='prefix' class='form-control' placeholder='Prefix'>
                    </div>


                    <div class="modal-footer">
                        <button id="formSubmit" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

