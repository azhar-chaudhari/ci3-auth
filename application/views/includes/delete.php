  <!--MODAL DELETE-->
  <form>
      <div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="lbl_delete"></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <strong><?php echo $this->lang->line('delete_confirm'); ?></strong>
                  </div>
                  <div class="modal-footer">
                      <input type="hidden" name="code_delete" id="code_delete" class="form-control">
                      <button type="button" class="btn btn-secondary" id="btn_delete_no" data-dismiss="modal"
                          title="<?php echo $this->lang->line('no'); ?>"><?php echo $this->lang->line('no'); ?></button>
                      <button type="button" id="btn_delete_yes" class="btn btn-primary"
                          title="<?php echo $this->lang->line('yes'); ?>"><?php echo $this->lang->line('yes'); ?></button>
                  </div>
              </div>
          </div>
      </div>
  </form>
  <!--END MODAL DELETE-->