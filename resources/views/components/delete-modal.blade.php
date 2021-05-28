{{-- Delete Modal --}}
<div class="modal fade" id="delete-modal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" id="delete-modal-form">
        @csrf
        @method('delete')

        <div class="modal-body">
          <p>{{ $slot }}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- End Delete Modal --}}

{{-- Delete Modal Script --}}
<script>
  $('#delete-modal').on('show.bs.modal', function (event) {
  let button = $(event.relatedTarget) 
  let url = button.data('url') 
  
  let modal = $(this)
  modal.find('#delete-modal-form').attr('action', url)
})
</script>