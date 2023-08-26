<?php

try {
    ${basename(__FILE__, ".php")} = function () {
        $id = "model_" . md5((string)microtime()); ?>
        <br>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?php echo $id ?>">
            Launch demo modal #<?php echo $id ?>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="<?php echo $id ?>" tabindex="-1" aria-labelledby="<?php echo $id ?>Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="<?php echo $id ?>Label">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        This is loaded from Modal API, time is <?php echo date("Y-m-d H:i:s") ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<?php
    };
} catch (Exception $e) {
    $data = [
        "Error" => $e->getMessage()
    ];
    $this->response($this->json($data), 404);
}
