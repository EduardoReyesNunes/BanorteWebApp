const express = require('express');
const cors = require('cors');
const app = express();
const port = 3000;

process.on('uncaughtException', (err) => {
    console.error('Error fatal del servidor:', err.message);
    process.exit(1);
});

try {
    const dataTelmex = require('./json/simulacion_telmex.json');
    const dataConagua = require('./json/simulacion_conagua.json');
    const dataCfe = require('./json/simulacion_cfe.json');
    const dataGas = require('./json/simulacion_gas.json');

    app.use(cors({ origin: '*' }));
    app.use(express.json());

    app.get('/api/telmex/recibos', (req, res) => {
        res.status(200).json(dataTelmex);
    });

    app.get('/api/conagua/facturas', (req, res) => {
        res.status(200).json(dataConagua);
    });

    app.get('/api/cfe/:numServicio', (req, res) => {
        const numServicio = req.params.numServicio;
        const recibo = dataCfe.find(item => item.Num_Servicio === numServicio);
        if (recibo) {
            res.status(200).json(recibo);
        } else {
            res.status(404).json({ mensaje: `Servicio CFE con número ${numServicio} no encontrado.` });
        }
    });

    app.get('/api/gas/contratos', (req, res) => {
        res.status(200).json(dataGas);
    });

    app.listen(port, () => {
        console.log(`Servidor iniciado en http://localhost:${port}`);
    });

} catch (error) {
    console.error(`Error al cargar un archivo JSON: ${error.message}`);
    process.exit(1);
}
