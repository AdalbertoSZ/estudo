var lista = []
let sele = document.getElementById('seln')
let res = document.getElementById('res')
function insere(){
    //alert('entrei')
    let txtn = document.getElementById('txtn')
    n = Number(txtn.value) 
    if (txtn.value.length == 0 || n <= 0 || n > 100) {
        alert('digite um numero entre 1 e 100')
    } else {
        if (lista.length == 0) {
            sele.innerHTML = ``
        }
        if (lista.indexOf(n)==-1){
            lista.push(n)
            let item = document.createElement('option')
            item.text = `Numero ${n} inserido a lista`
            sele.appendChild(item)
            res.innerHTML = ``
            txtn.value = ''
            txtn.focus()
            //alert(lista)
        } else {
            alert('numero já incluido')
        }   
    }
}
function fim() {
    //alert('fim')
    if (lista.length == 0){
        alert('digite algum numero')
    } else {
        lista.sort()
        let m = 0
        res.innerHTML = `<p>Voce inseriu ${lista.length} números</p>`
        res.innerHTML += `<p>O menor número inserido é ${lista[0]}</p>`
        res.innerHTML += `<p>O maior número inserido é ${lista[lista.length-1]}</p>`
        for (let x in lista) {
            m += lista[x]
        }
        res.innerHTML += `<p>A soma dos números é ${m}</p>`
        res.innerHTML += `<p>A média dos números é ${m/lista.length}</p>`
    }
}
