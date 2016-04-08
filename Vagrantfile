# -*- mode: ruby -*-

Vagrant.configure("2") do |config|

    config.vm.box = "scotch/box"
    config.vm.network "private_network", ip: "192.168.33.12"
    config.vm.hostname = "uhlu.dev"
    config.vm.synced_folder "api", "/var/www/public", :mount_options => ["dmode=777", "fmode=666"]

end
