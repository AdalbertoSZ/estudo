package fastcomp;

import java.awt.Color;
import java.awt.Component;
import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;


import javax.swing.JLabel;
import java.awt.Font;
import javax.swing.JMenuBar;
import javax.swing.JMenu;
import javax.swing.JMenuItem;
import javax.swing.JOptionPane;

import java.awt.event.ActionListener;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.awt.event.ActionEvent;
import javax.swing.JScrollPane;
import javax.swing.JTable;
import javax.swing.table.DefaultTableModel;
import javax.swing.table.TableCellRenderer;

import conexao.ModuloConector;

public class TelaPrincipal extends JFrame {

	private static final long serialVersionUID = 1L;
	private JPanel contentPane;
	public static JLabel lblCliente;
	public static JLabel lblIdcli;
	private JTable table;
	
	Connection conexao = null;
	PreparedStatement pst = null;
	ResultSet rs = null;

	/**
	 * Launch the application.
	 */
	public void obter_lista_imp() {
		String sql = "select * from Departamentos where cliente=?";
		conexao = ModuloConector.conectar();
		try {
			pst = conexao.prepareStatement(sql);
			pst.setString(1, lblIdcli.getText());
			rs = pst.executeQuery();
			//System.out.println(rs.getString("enderecoIp"));
			
			System.out.println(lblIdcli.getText());
			System.out.println(lblCliente.getText());
			if (rs.next()) {
				System.out.println("achei dados");
			} else {
				System.out.println("não achei dados");
			}
			conexao.close();
		} catch (Exception e) {
			JOptionPane.showMessageDialog(null, e);
		}
	}
	
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					TelaPrincipal frame = new TelaPrincipal();
					frame.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the frame.
	 */
	public TelaPrincipal() {
		setResizable(false);
		setTitle("Sistema de coleta de leitura de impressoras");
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(50, 50, 900, 600);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));

		setContentPane(contentPane);
		contentPane.setLayout(null);
		
		lblCliente = new JLabel("Cliente");
		lblCliente.setFont(new Font("Tahoma", Font.PLAIN, 14));
		lblCliente.setBounds(124, 30, 228, 14);
		contentPane.add(lblCliente);
		
		JLabel lblNewLabel = new JLabel("Cliente.:");
		lblNewLabel.setBounds(10, 30, 46, 14);
		contentPane.add(lblNewLabel);
		
		lblIdcli = new JLabel("");
		lblIdcli.setBounds(66, 30, 46, 14);
		contentPane.add(lblIdcli);
		
		JMenuBar menuBar = new JMenuBar();
		menuBar.setBounds(0, 0, 884, 22);
		contentPane.add(menuBar);
		
		JMenu menArq = new JMenu("Arquivo");
		menuBar.add(menArq);
		
		JMenuItem memArqSalvar = new JMenuItem("Salvar");
		memArqSalvar.setEnabled(false);
		menArq.add(memArqSalvar);
		
		JMenuItem memArqSair = new JMenuItem("Sair");
		memArqSair.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				int sair = JOptionPane.showConfirmDialog(null, "Tem certeza que deseja sair?", "Atenção" , JOptionPane.YES_NO_OPTION);
				if (sair == JOptionPane.YES_OPTION) {
					System.exit(0);
				}
			}
		});
		menArq.add(memArqSair);
		
		JMenu memAju = new JMenu("Ajuda");
		menuBar.add(memAju);
		
		JMenuItem memAjuSobre = new JMenuItem("Sobre");
		memAjuSobre.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				Sobre sobre = new Sobre();
				sobre.setVisible(true);
			}
		});
		memAju.add(memAjuSobre);
		
		
		table = new JTable(){
			public boolean isCellEditable(int rowIndex, int collIndex) {
				return false;
			}

			public Component prepareRenderer(TableCellRenderer renderer, int row, int column) {
				Component c = super.prepareRenderer(renderer, row, column);

				// Alternate row color

				if (!isRowSelected(row))
					c.setBackground(row % 2 == 0 ? getBackground() : new Color(240, 245, 245));

				return c;
			}
		};
		table.setShowVerticalLines(false);
		table.setShowHorizontalLines(false);
		table.setRowHeight(24);
		table.setModel(new DefaultTableModel(
			new Object[][] {
			},
			new String[] {
				"Status", "Endere\u00E7o IP", "Modelo", "Num. de S\u00E9rie", "Contador", "Instalado", "Atualizado"
			}
		));
		table.setBounds(0, 0, 800, 450);
		//contentPane.add(table);
		
		JScrollPane scrollPane = new JScrollPane(table);
		scrollPane.setBounds(20, 50, 850, 490);
		contentPane.add(scrollPane);
		
		obter_lista_imp();
	}
}
