let limitText = (selector, maxLength)=>{
    let element = document.querySelector(selector),
        truncated = element.innerText;

        if (truncated.length > maxLength) {
            truncated = truncated.substr(0,maxLength) + '...';
        }
        return truncated;
}

// document.querySelector('.limit').innerText = limitText('.limit', 10);

const allText = document.querySelectorAll('.limit');

allText.forEach(e=>{
    e.innerText = limitText('.limit', 50);
})