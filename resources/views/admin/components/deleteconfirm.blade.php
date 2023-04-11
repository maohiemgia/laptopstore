 {{-- delete modal --}}
 <!-- Modal -->
 <div class="modal fade" id="deleteconfirmmodal" tabindex="-1" aria-labelledby="deleteconfirmmodallabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title text-capitalize" id="exampleModalLabel">
                     Thông báo xác nhận
                 </h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <p class="text-bold fa-2x text-center">Xác nhận xóa?</p>

                 <div class="modal-footer justify-content-center">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>

                     <form method="POST" class="d-inline" id="delete-form-confirm">
                         @csrf
                         @method('DELETE')
                         <button type="submit" class="btn btn-danger">Xóa</button>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </div>
