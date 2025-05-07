document.addEventListener('DOMContentLoaded', (event) => {
    // Verifica se a preferência do modo escuro está armazenada no localStorage
    const darkMode = localStorage.getItem('darkMode');

    const body = document.body;
    const h2Elements = document.querySelectorAll('h2');
    const h4Elements = document.querySelectorAll('h4');
    const h6Elements = document.querySelectorAll('h6');
    const spanElements = document.querySelectorAll('span');
    const questaoElements = document.querySelectorAll('.questao');
    const toggleButton = document.getElementById('toggleDarkMode');
    const materialboxedImages = document.querySelectorAll('.materialboxed');
    const inputElements = document.querySelectorAll('input');
    const pElements = document.querySelectorAll('p');
    const hrElements = document.querySelectorAll('hr'); // Adiciona hr
    const verticalLineElements = document.querySelectorAll('.vertical-line'); // Adiciona .vertical-line

    // Aplica a classe de acordo com a preferência armazenada
    if (darkMode === 'enabled') {
        body.classList.add('dark');
        pElements.forEach(p => p.classList.add('dark'));
        h2Elements.forEach(h2 => h2.classList.add('dark'));
        h4Elements.forEach(h4 => h4.classList.add('dark'));
        h6Elements.forEach(h6 => h6.classList.add('dark'));
        spanElements.forEach(span => span.classList.add('dark'));
        questaoElements.forEach(questao => questao.classList.add('dark'));
        materialboxedImages.forEach(img => img.classList.add('dark'));
        inputElements.forEach(input => input.classList.add('dark'));
        hrElements.forEach(hr => hr.classList.add('dark')); // Aplica dark em hr
        verticalLineElements.forEach(line => line.classList.add('dark')); // Aplica dark em .vertical-line
    } else {
        body.classList.add('light');
        pElements.forEach(p => p.classList.add('light'));
        h2Elements.forEach(h2 => h2.classList.add('light'));
        h4Elements.forEach(h4 => h4.classList.add('light'));
        h6Elements.forEach(h6 => h6.classList.add('light'));
        spanElements.forEach(span => span.classList.add('light'));
        questaoElements.forEach(questao => questao.classList.add('light'));
        materialboxedImages.forEach(img => img.classList.add('light'));
        inputElements.forEach(input => input.classList.add('light'));
        hrElements.forEach(hr => hr.classList.add('light')); // Aplica light em hr
        verticalLineElements.forEach(line => line.classList.add('light')); // Aplica light em .vertical-line
    }

    // Atualiza o texto do botão inicialmente
    updateButtonText();

    // Alterna entre modo claro e escuro ao clicar no botão
    toggleButton.addEventListener('click', () => {
        body.classList.toggle('dark');
        body.classList.toggle('light');
        h2Elements.forEach(h2 => {
            h2.classList.toggle('dark');
            h2.classList.toggle('light');
        });
        h4Elements.forEach(h4 => {
            h4.classList.toggle('dark');
            h4.classList.toggle('light');
        });
        h6Elements.forEach(h6 => {
            h6.classList.toggle('dark');
            h6.classList.toggle('light');
        });
        spanElements.forEach(span => {
            span.classList.toggle('dark');
            span.classList.toggle('light');
        });
        questaoElements.forEach(questao => {
            questao.classList.toggle('dark');
            questao.classList.toggle('light');
        });
        pElements.forEach(p => {
            p.classList.toggle('dark');
            p.classList.toggle('light');
        });
        materialboxedImages.forEach(img => {
            img.classList.toggle('dark');
            img.classList.toggle('light');
        });
        inputElements.forEach(input => {
            input.classList.toggle('dark');
            input.classList.toggle('light');
        });
        hrElements.forEach(hr => {
            hr.classList.toggle('dark');
            hr.classList.toggle('light');
        });
        verticalLineElements.forEach(line => {
            line.classList.toggle('dark');
            line.classList.toggle('light');
        });

        // Atualiza o localStorage de acordo com a classe atual
        if (body.classList.contains('dark')) {
            localStorage.setItem('darkMode', 'enabled');
        } else {
            localStorage.setItem('darkMode', 'disabled');
        }

        // Atualiza o texto do botão
        updateButtonText();

        // Atualiza as classes das imagens materialboxed
        updateMaterialboxedImages(body.classList.contains('dark'));
    });

    // Atualiza o texto do botão com base no modo atual
    function updateButtonText() {
        if (body.classList.contains('dark')) {
            toggleButton.textContent = 'Escuro';
        } else {
            toggleButton.textContent = 'Claro';
        }
    }

    // Função para atualizar classes das imagens materialboxed
    function updateMaterialboxedImages(isDarkMode) {
        // Lógica para atualizar classes das imagens materialboxed, se necessário
    }

    // Inicializa as classes das imagens materialboxed com base no modo atual
    updateMaterialboxedImages(body.classList.contains('dark'));
});
