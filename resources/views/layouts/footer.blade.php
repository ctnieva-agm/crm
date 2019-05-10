    <div class="modal fade" id="spinner-modal" tabindex="-1" role="dialog" aria-labelledby="spinner-modal-title"
        aria-hidden="true" style="background: rgba(0, 0, 0, 0.50);">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="spinner-grow text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-secondary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-success" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-danger" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-warning" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-info" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function spinnersModal(option = 'show') {
            if(option=="show") {
                $('#spinner-modal').modal({
                    keyboard : false,
                    backdrop : 'static',
                });
            } else if(option =="hide") {
                $('#spinner-modal').modal('hide')
            }
        }
    </script>
    </body>
</html>