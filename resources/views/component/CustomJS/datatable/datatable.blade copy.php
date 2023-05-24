
<script>

    $(document).ready(function() {

        //Permission Or Action Button

        @if(isset($ActionButtons) && !empty($ActionButtons))
            var btns = '<button type="button" class="btn btn-sm btn-danger btn-glow dropdown-toggle left RolePermissionAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\n' +
                '<i class="ft-settings"></i> Action <span class="sr-only">Toggle Dropdown</span>\n' +
                '</button>\n' +
                '<div class="dropdown-menu dt-custom-btn">\n';

            @if(in_array('Delete',$ActionButtons)) btns = btns+'<a href="javascript:void(0)" class="dropdown-item aeshaz-confirm-alert RolePermissionDelete" data-aeshaz-type="Delete" data-aeshaz-url="{{url(Request()->path().'/action')}}" data-aeshaz-id="all-selected" > <i class="ft-trash-2"></i> Delete</a>\n'; @endif

            @if(in_array('Active',$ActionButtons)) btns = btns+'<a href="javascript:void(0)" class="dropdown-item aeshaz-confirm-alert RolePermissionUpdate" data-aeshaz-type="Active" data-aeshaz-url="{{url(Request()->path().'/action')}}" data-aeshaz-id="all-selected" > <i class="ft-check-circle"></i> Active</a>\n'; @endif

            @if(in_array('Inactive',$ActionButtons)) btns = btns+'<a href="javascript:void(0)" class="dropdown-item aeshaz-confirm-alert RolePermissionUpdate" data-aeshaz-type="Inactive" data-aeshaz-url="{{url(Request()->path().'/action')}}" data-aeshaz-id="all-selected" > <i class="ft-slash"></i> Inactive</a>\n'; @endif

            btns = btns+'</div>';

            $('.dt-buttons').append(btns);
        @endif

        var permissions = @php echo json_encode(Request()->input('this_form_permission')); @endphp;

        if(!permissions['insert']){
            $('.RolePermissionInsert').remove();
        }
        if(!permissions['update']){
            $('.RolePermissionUpdate').remove();
        }
        if(!permissions['delete']){
            $('.RolePermissionDelete').remove();
        }
        if(!permissions['view']){
            $('.RolePermissionView').remove();
        }
        if(!permissions['update'] && !permissions['delete']){
            $('.RolePermissionAction').remove();
        }
        //Permission Or Action Button End

    });

</script>

@include('component.CustomJS.confirm-alert')
