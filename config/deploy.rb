set :application, 'textbook'
set :repo_url, "git@github.com:sleepinglion/simple_manage_program.git"
set :branch, 'master'
# Default branch is :master
# ask :branch, `git rev-parse --abbrev-ref HEAD`.chomp

# Default deploy_to directory is /var/www/my_app_name

# Default value for :format is :airbrussh.
# set :format, :airbrussh
set :composer_install_flags, -> { "--no-interaction --optimize-autoloader --working-dir=#{shared_path}/application" }
# You can configure the Airbrussh format using :format_options.
# These are the defaults.
set :format_options, command_output: true, log_file: 'logs/capistrano.log', color: :auto, truncate: :auto

# Default value for :pty is false
set :pty, true

# Default value for :linked_files is []
append :linked_files, 'config/database.php'

# Default value for linked_dirs is []
#append :linked_dirs, 'public/files', 'application/logs', 'application/vendor'


namespace :deploy do
  desc 'Make Cache Directory'
  task :make_cache_directory do
    on roles(:app), in: :sequence, wait: 1 do
      within release_path do
          execute "chmod -R 777 #{release_path}/application/cache"
      end
    end
  end

  desc 'Make Minify'
  task :make_minify do
    on roles(:app), in: :sequence, wait: 1 do
      within release_path do
          execute "cd #{release_path}/public/assets/stylesheets;uglifycss --output common.min.css bootstrap.min.css animate.min.css bootstrap-datepicker.css style.css font-awesome.min.css index.css"
          execute "cd #{release_path}/public/assets/javascripts;uglifyjs --output common.min.js jquery-2.1.1.min.js popper.min.js bootstrap.min.js jquery-ui-1.10.3.custom.min.js jquery.form.min.js bootstrap-datepicker.min.js jquery.pagination.js common.js"
      end
    end
  end
  
  desc 'Sync Amazon'
  task :sync_amazon do
    on roles(:app), in: :sequence, wait: 1 do
      within release_path do
          execute "s3cmd sync --acl-public #{release_path}/public/assets s3://myfiterp-cafe"
      end
    end
  end

  #after :finishing, 'deploy:make_cache_directory'
  #after :finishing, 'deploy:make_minify'
  #after :finishing, 'deploy:sync_amazon'  
end

# Default value for default_env is {}
# set :default_env, { path: "/opt/ruby/bin:$PATH" }

# Default value for keep_releases is 5
# set :keep_releases, 5
