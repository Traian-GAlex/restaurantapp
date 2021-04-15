<div class="row">
    <div class="col-12">
        <button type="button" id="tablesViewerBtn" class="btn btn-outline-primary btn-block" value="true"><i
                class="las la-eye la-lg"></i> Show tables
        </button>
    </div>
</div>
<!-- Scrollable modal -->
<div id="tablesList"  class="modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tables</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="tablesModalBody" class="modal-body">

            </div>
            <div class="modal-footer">
                <button id="closeTablesListBtn" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@section("custom_head")
    @parent
    <script src="{{asset("js/cashier/tables.js")}}" defer></script>
@endsection

@section("custom_script")
    @parent

@endsection
