<?php
include('security.php'); 
include('includes/header.php');
include('includes/navbar.php'); 
?>

<!-- Finestra Modal con form inserimento dati -->
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Aggiungi un utente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">

        <div class="modal-body">
            
            <div style="color:red;font-weight:bold;font-style:italic">
                <label> *Tutti i campi sono obbligatori </label>
            </div>
            
            <div class="form-group">
                <label> Username </label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password" required>
            </div>
            <div class="form-group">
                <label>Ruolo Utente</label>
                <select name="usertype" class="form-control">
                   <option value="admin"> Admin </option>
                   <option value="user"> User </option>
                </select>
            </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div><!-- End Finestra Modal -->










<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Profili Utente &nbsp;&nbsp;|&nbsp;&nbsp;   
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Aggiungi un nuovo profilo utente
            </button>
    </h6>
  </div>

  <div class="card-body">
    
       
    <!-- End CODICE PER MESSAGGIO DOPO INSERIMENTO DATI -->         
    <?php 
    if(isset($_SESSION['success']) && $_SESSION['success'] !='')
    {
        echo '<h2 class="bg-primary"> '.$_SESSION['success'].' </h2>';
        unset($_SESSION['success']); 
    }
    if(isset($_SESSION['status']) && $_SESSION['status'] !='')
    {
        echo '<h2 class="bg-danger"> '.$_SESSION['status'].' </h2>';
        unset($_SESSION['status']); 
    } 
    ?>      
     <!-- End CODICE PER MESSAGGIO DOPO INSERIMENTO DATI -->              
                      
                                
    <div class="table-responsive">
     
     
      <!-- CODICE PER ESTRARRE I DATI DAL DATABASE "ADMINPANEL" --> 
      <?php 
        
            $query = "SELECT * FROM register ORDER BY id DESC";
            $query_run = mysqli_query($connection, $query);
        
       ?>

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> ID </th>
            <th> Username </th>
            <th>Email </th>
            <th>Password</th>
            <th>Ruolo Utente</th>
            <th>Modifica </th>
            <th>Elimina </th>
          </tr>
        </thead>
        <tbody>
        
        <?php 
        if(mysqli_num_rows($query_run) > 0)
        {
            while($row = mysqli_fetch_assoc($query_run))
                
            {
                ?>
     
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['password']; ?></td>
            <td><?php echo $row['usertype']; ?></td>
            <td>
               
                <!-- CODICE PER PULSANTE EDIT --> 
               <form action="register_edit.php" method="post">
                   <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                   <button type="submit" name="edit_btn" class="btn btn-success">Modifica</button>
               </form>
            </td>
            <td>
              <!-- CODICE PER PULSANTE DELETE --> 
                <form action="code.php" method="post">
                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                    <button type="submit"  name="delete_btn" class="btn btn-danger">Elimina</button>
                </form>
            </td>
          </tr>
          <?php 
           }
             
          }
          else {
              echo "No Record Found";           
          }
          ?>
        
        </tbody>
      </table>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>