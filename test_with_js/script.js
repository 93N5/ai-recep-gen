
const apiUrl = 'http://localhost:1234/v1/chat/completions'

let input = document.querySelector("input");
let button = document.querySelector("button");

button.addEventListener('click', () => {
    
    inputValue = input.value;
    
    console.log(inputValue);

    const data = {
        messages: [
            {
                role: "system", content: `Youre a expert in making recipes, And the user needs your help. The user wants to make a recipe with the following ingredients that the user gives you in the prompt of the user.`
            }, 
            {
                role: "user", content: `${inputValue}`
            }
        ],  
        temperature: 0.7,
    }

    try {
        fetch(apiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        })
        .then(response => response.json())
        .then(result => {
            console.log(result);
        })
    } catch (error) {
        console.log(error);
    }
});


