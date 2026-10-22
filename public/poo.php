	<?php
    const MAYUSCULAS = 1;
    const MAYUSCULAS = 0;
class Ciclo
{
    public const GRADO_MEDIO    = 'Medio';
    public const GRADO_SUPERIOR = 'Superior';
    

    public function __construct(
         public string $codCiclo,
         public string $nombre,
         public string $grado,
    ){
      $this->codCiclo = $codCiclo;
        $this->nombre = $nombre;
        $this->grado  = $grado;
    } 
    public function titulacion(): string
    {
        return $this->grado === self::GRADO_SUPERIOR ? 'Técnico Superior' : 'Técnico';
    }
    public function getNombre(): string {
        return strtoupper($this->nombre);
    }
    

}
$daw = new Ciclo('DAW, 'Desarrollo de Aplicaciones Web', Ciclo::GRADO_SUPERIOR);
?>