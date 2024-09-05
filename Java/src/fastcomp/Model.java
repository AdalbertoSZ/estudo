package fastcomp;

public class Model {
	private String indice;
	private String patrimonio;
	private String enderecoIp;
	private String contador;
	private String localizacao;
	private String dataLeitura;
	private String status;
	
	public Model() {
		super();
		// TODO Auto-generated constructor stub
	}
	public Model(String indice, String patrimonio, String enderecoIp, String contador, String localizacao,
			String dataLeitura, String status) {
		super();
		this.indice = indice;
		this.patrimonio = patrimonio;
		this.enderecoIp = enderecoIp;
		this.contador = contador;
		this.localizacao = localizacao;
		this.dataLeitura = dataLeitura;
		this.status = status;
	}
	public String getIndice() {
		return indice;
	}
	public void setIndice(String indice) {
		this.indice = indice;
	}
	public String getPatrimonio() {
		return patrimonio;
	}
	public void setPatrimonio(String patrimonio) {
		this.patrimonio = patrimonio;
	}
	public String getEnderecoIp() {
		return enderecoIp;
	}
	public void setEnderecoIp(String enderecoIp) {
		this.enderecoIp = enderecoIp;
	}
	public String getContador() {
		return contador;
	}
	public void setContador(String contador) {
		this.contador = contador;
	}
	public String getLocalizacao() {
		return localizacao;
	}
	public void setLocalizacao(String localizacao) {
		this.localizacao = localizacao;
	}
	public String getDataLeitura() {
		return dataLeitura;
	}
	public void setDataLeitura(String dataLeitura) {
		this.dataLeitura = dataLeitura;
	}
	public String getStatus() {
		return status;
	}
	public void setStatus(String status) {
		this.status = status;
	}
	
	
}
