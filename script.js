document.getElementById("form").addEventListener("submit", async function (event) {
    event.preventDefault();

    const login = document.getElementById("login").value.trim();
    const senha = document.getElementById("senha").value.trim();
    const nome = document.getElementById("nome").value.trim();
    const idade = document.getElementById("idade").value.trim();
    const cep = document.getElementById("cep").value.trim();
    const rua = document.getElementById("rua").value.trim();
    const bairro = document.getElementById("bairro").value.trim();
    const cidade = document.getElementById("cidade").value.trim();
    const estado = document.getElementById("estado").value.trim();

    let valid = true;

    if (!login || !senha || !nome || !idade || !cep || !rua || !bairro || !cidade || !estado) {
        console.error("PREENCHA TODOS OS CAMPOS");
        alert("Todos os campos precisam ser preenchidos.");
        valid = false;
    }

    if (valid && (idade <= 0 || idade > 120)) {
        console.error("INSIRA UMA IDADE VALIDA");
        alert("Insira uma idade válida.");
        valid = false;
    }

    if (valid && senha.length < 6) {
        console.error("A SENHA DEVE TER NO MINIMO 6 CARACTERES");
        alert("A senha deve conter no mínimo 6 caracteres.");
        valid = false;
    }

    if (valid && (cep.length !== 8 || !/^\d{8}$/.test(cep))) {
        console.error("CEP INVÁLIDO");
        alert("O CEP deve ter exatamente 8 dígitos numéricos.");
        valid = false;
    }

    // API de CEP

    if (valid) {
        const ruaPreenchida = document.getElementById("rua").value.trim();
        const bairroPreenchido = document.getElementById("bairro").value.trim();
        const cidadePreenchida = document.getElementById("cidade").value.trim();
        const estadoPreenchido = document.getElementById("estado").value.trim();

        if (!ruaPreenchida || !bairroPreenchido || !cidadePreenchida || !estadoPreenchido) {
            console.error("ENDEREÇO INCOMPLETO");
            alert("O endereço não foi encontrado. Verifique o CEP ou preencha manualmente.");
            valid = false;
        }
    }

    if (valid) {
        console.log("DADOS VALIDADOS COM SUCESSO");

        document.getElementById("form").submit();
    }
});

const cepInput = document.getElementById("cep");

cepInput.addEventListener("input", async function (event) {
    const cep = cepInput.value.trim();

    if (cep.length !== 8 || !/^\d{8}$/.test(cep)) {
        return;
    }

    let valid = true;

    try {
        const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
        const data = await response.json();

        if (data.erro) {
            console.error("CEP NÃO ENCONTRADO");
            alert("O CEP inserido não foi encontrado.");
            valid = false;
        } else {
            document.getElementById("rua").value = data.logradouro || "";
            document.getElementById("bairro").value = data.bairro || "";
            document.getElementById("cidade").value = data.localidade || "";
            document.getElementById("estado").value = data.uf || "";
        }
    } catch (error) {
        console.error("ERRO AO BUSCAR O CEP", error);
        alert("Ocorreu um erro ao buscar o CEP. Tente novamente.");
        valid = false;
    }

    const ruaPreenchida = document.getElementById("rua").value.trim();
    const bairroPreenchido = document.getElementById("bairro").value.trim();
    const cidadePreenchida = document.getElementById("cidade").value.trim();
    const estadoPreenchido = document.getElementById("estado").value.trim();

    if (!ruaPreenchida || !bairroPreenchido || !cidadePreenchida || !estadoPreenchido) {
        console.error("ENDEREÇO INCOMPLETO");
        alert("O endereço não foi encontrado. Verifique o CEP ou preencha manualmente.");
        valid = false;
    }

    if (!valid) {
        return;
    }
});