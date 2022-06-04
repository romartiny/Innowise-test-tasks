<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UserMove</title>
    <link href="/Public/assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="container-fluid body-content">
        <div class="row align-items-center">
            <div class="col-md-8 mx-auto form-block">
                <h1 class="text-center">UserMove</h1>
                <form action="index.php" method="post">
                    <input type="hidden" name="action" value="add">
                    <div class="form-outline">
                        <label for="name">Your Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="First and Last name" required>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="email">Your Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gender">Select gender</label>
                        <select id="gender" name="gender" class="form-select col-1">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <label for="status">Select status</label>
                        <select id="status" name="status" class="form-select col-4">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="button-block">
                        <a class="btn btn-secondary back-button" href="index.php">Back</a>
                        <button type="submit" value="Submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>