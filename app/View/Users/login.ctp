<div class="container">

      <?php echo $this->Form->create('User', array('class' => 'form-signin'));?>
        <h2 class="form-signin-heading">Login</h2>
        <?php echo $this->Form->input('username', array('label' => array('class'=>'sr-only'), 'placeholder' => 'Email', 'class' => 'form-control'));
        echo $this->Form->input('password', array('label' => array('class'=>'sr-only'), 'placeholder' => 'Senha', 'class' => 'form-control'));?>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me">Lembrar
          </label>
        </div>
        <?php echo $this->Form->end(array('label' => 'Entrar', 'class' => 'btn btn-lg btn-primary btn-block'));?>
      </form>

    </div> <!-- /container -->
