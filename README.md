# List User #

Block List User es un bloque para Moodle diseñado para docentes que necesitan acceder rápidamente al listado completo de usuarios de la plataforma desde su página personal. El bloque añade un botón o enlace que redirige a una página dedicada, donde se presenta una interfaz simple y eficiente para consultar y filtrar usuarios.

La página principal del plugin incluye un buscador que permite localizar usuarios por nombre o coincidencias parciales, y una grilla paginada que muestra hasta 50 registros por página. La información presentada proviene directamente de la tabla de usuarios de Moodle e incluye los siguientes campos esenciales:

- Nombre
- Apellido
- Email
- ID Number
- Username

Este plugin ofrece una experiencia ligera, clara y orientada a la productividad docente, facilitando la consulta rápida de usuarios sin necesidad de navegar por la administración del sitio.

## Installing via uploaded ZIP file ##

1. Log in to your Moodle site as an admin and go to _Site administration >
   Plugins > Install plugins_.
2. Upload the ZIP file with the plugin code. You should only be prompted to add
   extra details if your plugin type is not automatically detected.
3. Check the plugin validation report and finish the installation.

## Installing manually ##

The plugin can be also installed by putting the contents of this directory to

    {your/moodle/dirroot}/blocks/list_user

Afterwards, log in to your Moodle site as an admin and go to _Site administration >
Notifications_ to complete the installation.

Alternatively, you can run

    $ php admin/cli/upgrade.php

to complete the installation from the command line.

## License ##

2026 Renzo Medina <medinast30@gmail.com>

This program is free software: you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation, either version 3 of the License, or (at your option) any later
version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with
this program.  If not, see <https://www.gnu.org/licenses/>.
