<script type="text/javascript">
    function Delete($id) {


        if (confirm('Are you sure, Do you want to delete this ?')) {


            $("#delete-" + $id).submit();

        } else {

            event.preventDefault();

        }

    }
</script>