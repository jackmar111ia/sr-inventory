
<div class="row">
<iframe src='{{ URL::to("/approval-pending/clients/$currentUser")}}' id="myIframe"></iframe>

</div>

<style>
    iframe {
        overflow: scroll;
  width: 100%;
  border: 0;
  min-height: 350px;
}

.modal-body {
  -webkit-overflow-scrolling: touch !important;
  overflow-x: auto !important;
}
</style>

<script>
//redirect to specific tab
    $(document).ready(function () {
    $('#tabMenu a[href="#{{ old('tab') }}"]').tab('show')
    });
</script>		


<script>
    // Selecting the iframe element
    var iframe = document.getElementById("myIframe");
    
    // Adjusting the iframe height onload event
    iframe.onload = function(){
        iframe.style.height = iframe.contentWindow.document.body.scrollHeight + 'px';
    }
    </script>
