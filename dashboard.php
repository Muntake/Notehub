<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="style.css">


</head>

<body>
    <div class="note">
        <div class="welcome">
            <?php
            session_start();
            $user = $_SESSION['username'];
            echo "<h2>Welcome back $user!</h2>";
            ?>
            <button class="btn logoutButton" id="logout">Logout</button>
        </div>
        <div class="note-input">
            <h3 class="addNewNote">Add A New Note: </h3>
            <div class="note-wrapper">
                <form method='post'>
                    <br /><br />
                    <input type="text" name="note-title" id="note-title" placeholder="note title">
                    <textarea rows="5" name="note-content" placeholder="write note here..." id="note-content"></textarea>
                    <button type='submit' name='add_note' class='btn' value='Add Note'>
                        <span><i class="fas fa-plus"></i></span>
                        Add Note
                    </button>
                </form>
            </div>
        </div>

        <div class="note-list">
            <div class="note-item">
                <!-- temp note (for visualization purposes only) -->
                <h3>Sample Note</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Animi fugit omnis expedita porro adipisci, asperiores
                    facere ea. Voluptates quos quia consequatur explicabo.
                    Perspiciatis, repellat. Ea facere dolorum a iste maiores!</p>
                <button type="button" class="btn delete-note-btn">
                    <span><i class="fas fa-trash"></i></span>
                </button>
            </div>
            <?php
            $db = new PDO('mysql:host=localhost;dbname=notehub', 'root', 'rootpassword');
            $user = $_SESSION['username'];

            $user_notes = $db->query("SELECT title,body,note_id FROM notes WHERE username=$user;");
            foreach ($user_notes as $note) {
                $title = $note['title'];
                $body = $note['body'];
                $id = $note['note_id'];
                echo "<div class='note-item'><h3>$title</h3><p>$body</p><form method='post'><button type='submit' class='btn delete-note-btn' name ='remove_note' value='$id'><span><i class='fas fa-trash'></i></span></button></form></div>";
            }

            if (isset($_POST['remove_note'])) {
                $id = $_POST['remove_note'];
                $db->query("DELETE FROM notes WHERE note_id=$id;");
                header("Location: http://localhost/CP476/Cp476/dashboard.php");
            }
            if (isset($_POST['remove_all'])) {
                $username = $_SESSION['username'];
                $db->query("DELETE FROM notes WHERE notes.username = $username");
                header("Location: http://localhost/CP476/Cp476/dashboard.php);
            }
            if (isset($_POST['add_note'])) {
                echo var_dump($_POST);
                $title = $_POST['note-title'];
                $body = $_POST['note-content'];
                $db->query("INSERT INTO notes (title,body,username) VALUES ('$title','$body','$user');");
                header("Location: http://localhost/CP476/Cp476/dashboard.php");
            }
            //$arr = array(1 => "this is m1",2 => "this is m2", 3 => "this is m3");
            // foreach($arr as $id => $value) {
            //     echo "<div><h3>{$_SESSION['user_id']}</h3><p>{$value} {$id}</p></html><form method='post'><input type = 'submit' name='remove_note' value='{$id}'></form><span><i class = 'fas fa-trash'></i></span>Remove</button></div>";
            // }
            ?>
        </div>

        <form method='post'><input type = 'submit' value= 'Remove all' class = 'btn delete-note-btn' name='remove_all'></form>
    </div>


</body>

<style>
    :root {
        --default: #F1A208;
    }

    body {
        line-height: 1.5;
        font-weight: 300;
    }

    .note {
        max-width: 1080px;
        margin: 3rem auto;
        padding: 0 1.5rem;
    }

    .welcome h2 {
        display: inline-block;
        position: relative;
        margin-top: 20px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 2.6rem;
        align-content: center;
        opacity: 0.9;
    }

    .note-input h3 {
        color: var(--default);
    }

    .note-wrapper {
        margin: 0.7rem 0;
        padding: 0.5rem 0;
    }

    #note-title,
    #note-content {
        width: 100%;
        border: 2px solid rgba(0, 0, 0, 0.2);
        font-size: 1.05rem;
        padding: 0.55rem;
        margin-bottom: 0.8rem;
        border-radius: 2px;
    }

    #note-content {
        resize: none;
    }

    #note-title:focus,
    #note-content:focus {
        outline: 0;
    }

    .btn {
        background: var(--default);
        border: 2px solid var(--default);
        color: #fff;
        padding: 0.55rem 0;
        width: 120px;
        border-radius: 2px;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.5s ease-in-out;
    }

    .btn:focus {
        outline: 0;
    }

    .btn:hover {
        background: #f29179;
        box-shadow: 0 0 8px 0 rgba(255, 96, 72, 0.33);
    }

    .note-list {
        margin: 2rem 0;
        background: var(--default);
        padding: 2rem;
        border-radius: 2px;
    }

    .note-item {
        background: #fff;
        margin: 1rem;
        padding: 1.5rem;
        border-radius: 2px;
        box-shadow: 0 0 7px 0 rgba(0, 0, 0, 0.3);
    }

    .note-item h3 {
        margin-bottom: 1rem;
    }

    .note-item p {
        padding-bottom: 0.8rem;
    }

    .note-item .btn {
        margin-top: 0.8rem;
        background: #fff;
        border: 2px solid var(--default);
        color: var(--default);
    }

    #addNewNote {
        text-align: left;
        color: green;
    }

    #welcome {
        text-align: left;
    }

    #welcome {
        display: inline-block;
    }

    .logoutButton {
        margin-top: 30px;
        margin-left: 300px;
        float: right;
        vertical-align: top;
    }

    .logoutButton:hover {
        background: #f09885;
        box-shadow: 0 0 8px 0 rgba(255, 96, 72, 0.33);
    }

    @media(min-width: 992px) {
        .note-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /*** alert ***/
    .warning {
        border-color: #659de6 !important;
    }
</style>