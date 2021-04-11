function getQueryMsg() {
  const params = new URLSearchParams(window.location.search);
  if (params.has('status') || params.has('error')) {
    const val = params.get('status')
    const val2 = params.get('error');;
    if (val == 'blogDeleted') {
      window.alert("Blogpost was deleted! if it is still there delete all comments 1st");
    } else if (val == 'commentDeleted') {
      window.alert("Comment was deleted for ever!");
    } else if (val2 == 'stmtFailed') {
      window.alert("Something went wrong!");
    } else if (val2 == 'none') {
      window.alert("Full success");
    }
  }
}
getQueryMsg();
