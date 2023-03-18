function editGenre(Id) {
    window.location = "index.php?menu=genre_edit&gid=" + Id;
}

function deleteGenre(Id) {
    const confirm = window.confirm('Are you sure you want to delete?');
    if(confirm){
        window.location = "index.php?menu=genre&cmd=del&gid=" + Id;
    }
}
