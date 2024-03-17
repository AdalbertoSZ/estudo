let amigo = {nome:'jose',sexo:'M',peso:80,engordar(p=0){
    console.log('Engordou')
    this.peso += p
}}
console.log(typeof amigo)
amigo.engordar(1)
console.log(amigo)