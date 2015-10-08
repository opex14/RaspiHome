# RaspiHome
Please do not download it yet. It's barely working and contain very shitty code. Uploaded here just for backups at this time.

~~Настройка LIRC~~

1. sudo apt-get install lirc

2. в /etc/modules: 
```
  lirc_dev
  lirc_rpi gpio_in_pin=23 gpio_out_pin=17
```

3. в /etc/lirc/hardware.conf
```
  ########################################################
# /etc/lirc/hardware.conf
#
# Arguments which will be used when launching lircd
LIRCD_ARGS="--uinput"

# Don't start lircmd even if there seems to be a good config file
# START_LIRCMD=false

# Don't start irexec, even if a good config file seems to exist.
# START_IREXEC=false

# Try to load appropriate kernel modules
LOAD_MODULES=true

# Run "lircd --driver=help" for a list of supported drivers.
DRIVER="default"
# usually /dev/lirc0 is the correct setting for systems using udev
DEVICE="/dev/lirc0"
MODULES="lirc_rpi"

# Default configuration files for your hardware if any
LIRCD_CONF=""
LIRCMD_CONF=""
########################################################
```

4. в /boot/config.txt
```
  dtoverlay=lirc-rpi,gpio_in_pin=23,gpio_out_pin=17
```

5. в /etc/lirc/lircd.conf
```
begin remote

  name  Microlab
  bits           16
  flags SPACE_ENC|CONST_LENGTH
  eps            30
  aeps          100

  header       8933  4477
  one           610  1626
  zero          610   525
  ptrail        620
  repeat       8984  2198
  pre_data_bits   16
  pre_data       0xFF
  gap          108650
  toggle_bit_mask 0x0

      begin codes
          POWER                    0x00FF
          INPUT                    0x20DF
          RESET                    0xA05F
          MUTE                     0x40BF
          VOL_UP                   0x8877
          VOL_DOWN                 0x08F7
          REAR_UP                  0x10EF
          REAR_DOWN                0x30CF
          CENTER_UP                0x906F
          CENTER_DOWN              0xB04F
          SUB_UP                   0x50AF
          SUB_DOWN                 0x708F
          MODE                     0x609F
      end codes

end remote
```

5. sudo reboot
