<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>UserMove</title>
</head>
<body>
<div class="container">
    <h2 class="center">UserMove</h2>
    <div class="center">
        <form action="/index.php" method="post">
            <div class="row">
                <div class="col">
                    <input type="text" name="name" class="form-control" placeholder="Name">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
            </div>
            <select name="gender">
                <option>Male</option>
                <option>Female</option>
            </select>
            <select name="status">
                <option>Active</option>
                <option>Inactive</option>
            </select>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
</div>
</body>
</html>