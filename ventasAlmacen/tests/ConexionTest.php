<?php 
    use PHPUnit\Framework\TestCase;

    require_once "clases/Conexion.php"; // Asegúrate de que la ruta sea correcta

    class ConexionTest extends TestCase {
        
        private $conexion;

        protected function setUp(): void {
            $obj = new conectar();
            $this->conexion = $obj->conexion();
        }

        public function testConexionExitosa() {
            $this->assertInstanceOf(mysqli::class, $this->conexion, "La conexión no es una instancia de mysqli.");
        }

        public function testConexionNoEsNula() {
            $this->assertNotNull($this->conexion, "La conexión a la base de datos es nula.");
        }

        public function testConsultaSimple() {
            $sql = "SELECT 1";
            $result = mysqli_query($this->conexion, $sql);
            
            $this->assertTrue($result !== false, "La consulta no se ejecutó correctamente.");
        }
    }
?>
