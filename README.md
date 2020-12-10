# DT173GM5_BACKEND
http://willbur.nu/dt173g/API/rest.php
```
DELETE:
    const data = { code: <some value>}
    fetch('http://localhost:8080/RestwebbtjM5/API/rest.php', {
        method: 'DELETE',
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            
        })
        .catch(error => {
            console.log('Error: ', error);
        })
        
POST:
        const data = {
            code: <some value>,
            course_name: <some value>,
            syllabus: <some value>,
            progression: <some value>
        }
        fetch('http://localhost:8080/RestwebbtjM5/API/rest.php', {
            method: 'POST',
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
                
            })
            .catch(error => {
                console.log('Error: ', error);
            })
            
PUT:
        const data = {
            code: <some value>,
            newCode: <some value>,
            course_name: <some value>,
            syllabus: <some value>,
            progression: <some value>
        }
        fetch('http://localhost:8080/RestwebbtjM5/API/rest.php', {
            method: 'POST',
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
                
            })
            .catch(error => {
                console.log('Error: ', error);
            })
  
  GET:
   fetch('http://localhost:8080/RestwebbtjM5/API/rest.php')
        .then(response => response.json())
           .then(data => {
                
            })
            .catch(error => {
                console.log('Error: ', error);
            })
```
