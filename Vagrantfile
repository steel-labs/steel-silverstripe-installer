# -*- mode: ruby -*-
# vi: set ft=ruby :


# This Vagrantfile is intended to be used with universal-vagrant
# https://github.com/anwarishak/universal-vagrant/releases
#
# This is a sample Vagrantfile. To use it:
# 1. Make a copy of this file in your web root
# 2. Rename file to "Vagrantfile"
# 3. Make any adjustments below (e.g. comment/uncomment provisioners as required, set
#    permissions of folders, extra manual shell commands when provisioning)
# 4. Run > vagrant up

VAGRANTFILE_API_VERSION = "2"

# Change the path to universal-vagrant, including a trailing slash
PATH_TO_UNIVERSAL_VAGRANT = "@__PathToVagrant__"

PROJECT_WEBROOT = "@__ProjectRoot__"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  # Basic box
  config.vm.box = "precise32"
  config.vm.box_url = "http://files.vagrantup.com/precise32.box"
  config.vm.hostname = "@__HostName__"

  # Networking: port forwarding
  config.vm.network :forwarded_port, guest: 80, host: 8080, auto_correct: true

  config.vm.network :private_network, ip: "10.11.12.13"

  # Synced folders (also add items here to set folder permissions)
  # Vagrant v1.1+
  config.vm.synced_folder "./", "/vagrant", id: "vagrant-root",
    nfs_export: true,
    type: "nfs"

  config.vm.provider :virtualbox do |vb|
    vb.customize ["modifyvm", :id, "--memory", "512"]
    vb.customize ["modifyvm", :id, "--hwvirtex", "off"]
  end

  config.ssh.shell = "bash -c 'BASH_ENV=/etc/profile exec bash'"
  config.vm.provision "shell", path: PATH_TO_UNIVERSAL_VAGRANT + "scripts/bootstrap.sh"
  config.vm.provision "shell",
      path: PATH_TO_UNIVERSAL_VAGRANT + "scripts/LAMP-install.sh",
      args: "-v -r " + PROJECT_WEBROOT + " -n php5.6"
  # Download adminer
  config.vm.provision "shell",
      inline: "wget http://www.adminer.org/latest-mysql-en.php -O " + PROJECT_WEBROOT + "/adminer.php"

  config.vm.provision "shell",
      path: PATH_TO_UNIVERSAL_VAGRANT + "scripts/mysql.sh",
      args: "-v -d @__DBName__ -u @__DBUser__ -p @__DBPsw__"
  config.vm.provision "shell",
      path: PATH_TO_UNIVERSAL_VAGRANT + "scripts/composer.sh",
      args: "-v -r " + PROJECT_WEBROOT
  config.vm.provision "shell",
      inline: "sed -e '/^bind\-address/ s/^#*/#/' -i /etc/mysql/my.cnf && service mysql restart"

  # Do extra bits of provisioning/configuration, if required

  #$script = "
  #echo \"Doing some last minute provisioning\"
  #rm /var/www/default/public_html
  #ln -fs /vagrant/webroot /var/www/default/public_html
  #service apache2 restart
  #"

  # Uncomment the next line to enable the extra bits of provisioning/configuration
  #config.vm.provision "shell", inline: $script

end