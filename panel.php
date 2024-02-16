<?php
   require('./function.php');

   if (! authenticated()) {
      redirect('login.php');
   }

 $posts = get_data('post');
 $user = get_user_data();
 ?>
 
 <html>
     <head>
         <title>Panel</title>
 
         <link rel="stylesheet" href="<?= assts('css/style.css') ?>">
         <link rel="stylesheet" href="<?= assts('css/panel.css') ?>">
     </head>
     <body>
         <main>
             <nav>
                 <ul>
                     <li><a href="<?= BASE_URL ?>index.php">MainWebsite</a></li>
                     <li><a href="<?= BASE_URL ?>panel.php">Panel</a></li>
                     <li><a href="<?= BASE_URL ?>create.php">Create post</a></li>
                     <li><a href="<?= BASE_URL ?>logout.php">Logout</a></li>
                 </ul>
                 <ul>
                     <li><?= $user['name'] . ' ' . $user['family'] ?></li>
                 </ul>
             </nav>
             <section class="content">
                 <?php if($posts): ?>
                     <table>
                         <thead>
                             <tr>
                                 <th>ID</th>
                                 <th>Title</th>
                                 <th>Category</th>
                                 <th>View</th>
                                 <th>Date</th>
                                 <th>Action</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php foreach($posts as $post): ?>
                                 <tr>
                                     <td><?= $post['id'] ?></td>
                                     <td><?= $post['title'] ?></td>
                                     <td><?= $post['category'] ?></td>
                                     <td><?= $post['view'] ?> view</td>
                                     <td><?= date('Y M d', strtotime($post['date'])) ?></td>
                                     <td>
                                         <a href="./edit.php?id=<?= $post['id'] ?>">Edit</a>
                                         <a href="./delete.php?id=<?= $post['id'] ?>">Delete</a>
                                     </td>
                                 </tr>
                             <?php endforeach ?>
                         </tbody>
                     </table>
                 <?php else: ?>
                     <div>
                         Does not exist any data.
                     </div>
                 <?php endif ?>
             </section>
         </main>
     </body>
 </html>