
function vowelsAndConsonants(s) {
    let loud = ['a', 'e', 'i', 'o', 'u'];
    let ax = [], bx = [];
    for (let i = 0; i < s.length; i++) {
        if (loud.indexOf(s[i].toLowerCase()) == -1) {
            bx.push(s[i]);
        } else {
            ax.push(s[i]);
        }  
    }
    ax.forEach((x)=>{
        console.log(x);
    });
    bx.forEach((x)=>{
        console.log(x);
    });
}
vowelsAndConsonants("javascriptloops");