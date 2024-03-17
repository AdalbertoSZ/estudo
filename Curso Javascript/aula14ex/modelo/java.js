function xyz(){
    //window.alert ('entrei')
    var inic = document.getElementById('inic')
    var fim = document.getElementById('fim')
    var passo = document.getElementById('passo')
    var res = document.getElementById('res')
    var vini = Number(inic.value)
    var vfim = Number(fim.value)
    var vpasso = Number(passo.value)
    var w = vini
    var saida = 'Contando '
    if (vfim>vini){
        
        if (vpasso > 0){
            //res.innerHTML = `<p>Contando` 
            while (w <= vfim){
                saida += String(w)
                saida += ' \u{1f449}'
                w = w + vpasso
            }
            saida += ' \u{1f3c1}'
            res.innerHTML = `<p> ${saida} </p>`
        }else{
            alert('passo tem que ser maior que 0')
        }
    }else {
        alert('Valor final tem que ser maior que inicial')
    }
    
    
}
function tabuada(){
    //alert('entrei')
    let txtn = document.getElementById('txtn')
    let n = Number(txtn.value)
    let res = document.getElementById('res')
    let r = 0
    res.innerHTML = ``
    //alert(n)
    if (txtn.value.length  == 0) {
        alert('Erro - Falta definir operador')
    } else {
        //res.innerHTML = `<p>${n}</p>`
        for (var c=1; c <=10 ; c++){
            r = c * n
            res.innerHTML += `${n} x ${c} = ${r} <br>`
        }
    }
    
}