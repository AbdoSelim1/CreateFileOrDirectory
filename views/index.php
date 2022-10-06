<!doctype html>
<html lang="en">

<head>
    <title>Create Folder Or File</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>


    <div class="col-12 bg-dark " style="min-height: 100vh;">
        <div class="col-12 p-2">
            <?php
            session_start();
            foreach ($_SESSION['errors'] as $location => $errors) {
                foreach ($errors as $key => $error) {
                    foreach ($error as $in => $value) {
                        echo "<div class='alert alert-danger text-center col col-lg-6 mx-auto'>$value</div>";
                        unset($_SESSION['errors'][$location][$key][$in]);
                    }
                }
            }

            if (isset($_SESSION['response']['success']['massage'])) {
                echo "<div class='alert alert-success text-center col col-lg-6 mx-auto'>{$_SESSION['response']['success']['massage']}</div>";
                unset($_SESSION['response']['success']);
            } elseif (isset($_SESSION['response']['error']['massage'])) {
                echo "<div class='alert alert-danger text-center col col-lg-6 mx-auto'>{$_SESSION['response']['error']['massage']}</div>";
                unset($_SESSION['response']['error']);
            }
            ?>
        </div>
        <div class="row justify-content-center my-3">
            <h2 class="my-4 text-white">Create Folder Or File</h2>
            <div class="col-12 row justify-content-center">
                <button class="btn btn-success mx-2 active" id="create_folder">Create Folders</button>
                <button class="btn btn-success mx-2" id="create_file">Create Files</button>
            </div>
        </div>
        <div class="col-12">
            <form action="../index.php" method="post" class="row justify-content-center align-items-center">
                <div class="col-12 col-lg-6 bg-secondary rounded p-4" id="folder">
                    <div class="form-group">
                        <label class="text-white" for="folder">Enter Folder Name*</label>
                        <input type="text" name="folder_name" id="folder_name"  class="form-control" value="<?= isset($_SESSION['oldValues']['folder_name']) ?$_SESSION['oldValues']['folder_name'] :""?>">
                        <small id="helpId" class=" badge badge-danger">Help text</small>
                    </div>

                </div>
                <div class="col-12 col-lg-6 bg-secondary rounded p-4 d-none" id="file">
                    <div class="form-group">
                        <label class="text-white" for="file_name">Enter File Name*</label>
                        <input type="text" id="file_name" class="form-control" value='<?= isset($_SESSION['oldValues']['file_name']) ?$_SESSION['oldValues']['file_name'] :""?>' >
                        <small id="helpId" class=" badge badge-danger">Help text</small>
                    </div>
                    <div class="form-group">
                        <label class="text-white" for="file_type">Choose File Type*</label>
                        <select id="file_type" class="form-control">
                            <option value="php"<?= isset($_SESSION['oldValues']['file_type'])?$_SESSION['oldValues']['file_type'] == "php" ?"selected":"":""?>>php</option>
                            <option value="text"<?= isset($_SESSION['oldValues']['file_type'])?$_SESSION['oldValues']['file_type'] == "text" ?"selected":"":""?>>text</option>
                            <option value="json"<?= isset($_SESSION['oldValues']['file_type'])?$_SESSION['oldValues']['file_type'] == "json" ?"selected":"":""?>>json</option>
                        </select>
                        <small id="helpId" class="badge badge-danger">Help text</small>
                    </div>
                    <div class="form-group">
                        <label class="text-white" for="file_content"></label>
                        <textarea id="file_content" rows="20" class="form-control " style="height:300px"><?= isset($_SESSION['oldValues']['file_content']) ?$_SESSION['oldValues']['file_content'] :""?></textarea>
                    </div>
                </div>
                <div class="col-12 text-center p-3">
                    <input type="submit" value="Create" id="create" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        let create_folder = document.getElementById('create_folder');
        let create_file = document.getElementById('create_file');
        let folderBox = document.getElementById('folder');
        let fileBox = document.getElementById('file');

        create_folder.onclick = function() {
            folderBox.classList.remove('d-none')
            fileBox.classList.add('d-none');
            this.classList.add('active')
            create_file.classList.remove('active')
            for (el of folderBox.children) {
                el.children[1].setAttribute('name', el.children[1].getAttribute('id'))
            }
            for (el of fileBox.children) {
                el.children[1].removeAttribute('name')
            }

        }
        create_file.onclick = function() {
            folderBox.classList.add('d-none')
            fileBox.classList.remove('d-none');
            this.classList.add('active')
            create_folder.classList.remove('active')
            for (el of fileBox.children) {
                el.children[1].setAttribute('name', el.children[1].getAttribute('id'))
            }
            for (el of folderBox.children) {
                el.children[1].removeAttribute('name')
            }
        }

        function fixedBox() {
            folderNone = folderBox.className;
            fileNone = fileBox.className
            if (folderNone.endsWith('d-none')) {
                folderBox.classList.add('d-none')
                fileBox.classList.remove('d-none')
            } else {
                folderBox.classList.remove('d-none')
                fileBox.classList.add('d-none')
            }
        }
        // document.getElementById('create').onclick = fixedBox();
    </script>
</body>

</html>