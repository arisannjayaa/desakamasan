ClassicEditor.create(document.querySelector("#editor"), {
    toolbar: {
        items: [
            "heading",
            "|",
            "bold",
            "italic",
            "link",
            "bulletedList",
            "numberedList",
            "blockQuote",
            "insertTable",
            "undo",
            "redo",
        ],
    },
})
    .then((editor) => {
        // console.log('Editor berhasil dibuat', editor);
    })
    .catch((error) => {
        // console.error(error);
    });
