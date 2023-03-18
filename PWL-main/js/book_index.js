function editBook(Id) {
    window.location = "index.php?menu=book_edit&gid=" + Id;
}

function deleteBook(Id) {
    const confirm = window.confirm('Are you sure you want to delete?');
    if(confirm){
        window.location = "index.php?menu=book&cmd=del&gid=" + Id;
    }
}

function editCover(isbn) {
    window.location = 'index.php?menu=cover_update&isbn=' + isbn;
  }