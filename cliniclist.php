<?php include'header.php'; ?>

    <div class="modal fade" id="clinicEmbedMap" tabindex="-1" role="dialog" aria-labelledby="clinicEmbedMap">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Embed Map</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-auto" id="embed-map-container"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<?php include'footer.php'; ?>

<script type="text/javascript">
    function showEmbedMap(el) {
        var embedHtml = $(el).attr('data-embed');
        var $embedModalBody = $("#embed-map-container");

        $embedModalBody.html("");
        $embedModalBody.html(embedHtml);
    }
</script>