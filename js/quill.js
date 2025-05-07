// Inicializar o editor Quill
var quill = new Quill('#editor-container', {
    theme: 'snow',
    modules: {
        syntax: true,
        toolbar: [
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
            ['bold', 'italic', 'underline'],
            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
            ['link', 'image', 'video'],
            ['code-block'],
            [{ 'align': [] }],
            [{ 'color': [] }, { 'background': [] }],
            ['clean'],
            ['table']
        ],
        table: true
    }
});

// Definir o conteúdo do editor com o valor do campo escondido
/* var descricao = document.getElementById('descricao').value;
quill.root.innerHTML = descricao; */

// Atualizar o campo escondido quando o conteúdo do editor mudar
/* quill.on('text-change', function() {
    document.getElementById('descricao').value = quill.root.innerHTML;
});
*/
// Atualizar o campo escondido quando o formulário for submetido
document.querySelector('form').onsubmit = function() {
    var descricao = document.querySelector('input[name=descricao]');
    descricao.value = quill.root.innerHTML;
};